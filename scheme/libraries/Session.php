<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * @package LavaLust
 * @author Ronald...
 */

class Session {

	private $config;
	private $match_ip;
	private $match_fingerprint;
	private $userdata;

	public function __construct()
	{
		// Load session config
		$this->config =& get_config();
		$this->match_ip = $this->config['sess_match_ip'];
		$this->match_fingerprint = $this->config['sess_match_fingerprint'];

		/**
		 * ---------------------------------------------
		 * 🧩 CONFIGURE SESSION BEFORE STARTING IT
		 * ---------------------------------------------
		 */
		if (session_status() === PHP_SESSION_NONE) {

			// --- Cookie name ---
			if (!empty($this->config['cookie_prefix'])) {
				$this->config['cookie_name'] = $this->config['sess_cookie_name']
					? $this->config['cookie_prefix'] . $this->config['sess_cookie_name']
					: NULL;
			} else {
				$this->config['cookie_name'] = $this->config['sess_cookie_name']
					? $this->config['sess_cookie_name']
					: NULL;
			}

			if (empty($this->config['cookie_name'])) {
				$this->config['cookie_name'] = ini_get('session.name');
			} else {
				ini_set('session.name', $this->config['cookie_name']);
			}

			// --- Session expiration ---
			if (empty($this->config['sess_expiration'])) {
				$this->config['sess_expiration'] = (int) ini_get('session.gc_maxlifetime');
			} else {
				$this->config['sess_expiration'] = (int) $this->config['sess_expiration'];
				ini_set('session.gc_maxlifetime', $this->config['sess_expiration']);
			}

			// --- Cookie expiration ---
			if (isset($this->config['cookie_expiration'])) {
				$this->config['cookie_expiration'] = (int) $this->config['cookie_expiration'];
			} else {
				$this->config['cookie_expiration'] =
					(!isset($this->config['sess_expiration']) && $this->config['sess_expire_on_close'])
						? 0
						: (int) $this->config['sess_expiration'];
			}

			// --- Secure cookie params ---
			session_set_cookie_params([
				'lifetime' => $this->config['cookie_expiration'],
				'path'     => $this->config['cookie_path'],
				'domain'   => $this->config['cookie_domain'],
				'secure'   => $this->config['cookie_secure'],
				'httponly' => TRUE,
				'samesite' => $this->config['cookie_samesite']
			]);

			// --- Security tweaks ---
			ini_set('session.use_trans_sid', 0);
			ini_set('session.use_strict_mode', 1);
			ini_set('session.use_cookies', 1);
			ini_set('session.use_only_cookies', 1);
			ini_set('session.sid_length', $this->_get_sid_length());

			// --- Choose session handler ---
			if (!empty($this->config['sess_driver']) && $this->config['sess_driver'] == 'file') {
				require_once 'Session/FileSessionHandler.php';
				$handler = new FileSessionHandler();
				session_set_save_handler($handler, TRUE);
			}
		}

		// --------------------------------------------
		// ✅ Start the session safely now
		// --------------------------------------------
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}

		/**
		 * ---------------------------------------------
		 * 🧠 VERIFY SESSION DATA
		 * ---------------------------------------------
		 */
		if (empty($_SESSION['fingerprint'])) {
			$_SESSION['fingerprint'] = $this->generate_fingerprint();
		} elseif ($this->match_fingerprint && $_SESSION['fingerprint'] != $this->generate_fingerprint()) {
			return FALSE;
		}

		if (isset($_SESSION['ip_address']) && $this->match_ip) {
			if ($_SESSION['ip_address'] != $_SERVER['REMOTE_ADDR']) {
				return FALSE;
			}
		}

		$_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];

		if (isset($_COOKIE[$this->config['cookie_name']])) {
			preg_match('/(' . session_id() . ')/', $_COOKIE[$this->config['cookie_name']], $matches);
			if (empty($matches)) {
				unset($_COOKIE[$this->config['cookie_name']]);
			}
		}

		// --- Regenerate time ---
		$regenerate_time = (int) $this->config['sess_time_to_update'];
		if ((empty($_SERVER['HTTP_X_REQUESTED_WITH']) ||
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') &&
			($regenerate_time > 0)) {

			if (!isset($_SESSION['last_session_regenerate'])) {
				$_SESSION['last_session_regenerate'] = time();
			} elseif ($_SESSION['last_session_regenerate'] < (time() - $regenerate_time)) {
				$this->sess_regenerate((bool) $this->config['sess_regenerate_destroy']);
			}
		}

		// --- Refresh cookie ---
		elseif (isset($_COOKIE[$this->config['cookie_name']]) &&
			$_COOKIE[$this->config['cookie_name']] === $this->session_id()) {

			$expiration = empty($this->config['cookie_expiration'])
				? 0
				: time() + $this->config['cookie_expiration'];

			setcookie(
				$this->config['cookie_name'],
				$this->session_id(),
				[
					'samesite' => $this->config['cookie_samesite'],
					'secure'   => $this->config['cookie_secure'],
					'expires'  => $expiration,
					'path'     => $this->config['cookie_path'],
					'domain'   => $this->config['cookie_domain'],
					'httponly' => $this->config['cookie_httponly']
				]
			);
		}

		$this->_lava_init_vars();
	}

	// ------------------------ Helper Methods ------------------------

	public function generate_fingerprint()
	{
		foreach (['ACCEPT_CHARSET', 'ACCEPT_ENCODING', 'ACCEPT_LANGUAGE', 'USER_AGENT'] as $name) {
			$key[] = empty($_SERVER['HTTP_' . $name]) ? NULL : $_SERVER['HTTP_' . $name];
		}
		return md5(implode("\0", $key));
	}

	protected function _lava_init_vars()
	{
		if (!empty($_SESSION['__lava_vars'])) {
			$current_time = time();
			foreach ($_SESSION['__lava_vars'] as $key => &$value) {
				if ($value === 'new') {
					$_SESSION['__lava_vars'][$key] = 'old';
				} elseif ($value === 'old' || $value < $current_time) {
					unset($_SESSION[$key], $_SESSION['__lava_vars'][$key]);
				}
			}
			if (empty($_SESSION['__lava_vars'])) {
				unset($_SESSION['__lava_vars']);
			}
		}
		$this->userdata =& $_SESSION;
	}

	private function _get_sid_length()
	{
		$bits_per_character = (int) ini_get('session.sid_bits_per_character');
		$sid_length = (int) ini_get('session.sid_length');
		if (($bits = $sid_length * $bits_per_character) < 160)
			$sid_length += (int) ceil((160 % $bits) / $bits_per_character);
		return $sid_length;
	}

	public function sess_regenerate($destroy = FALSE)
	{
		$_SESSION['last_session_regenerate'] = time();
		session_regenerate_id($destroy);
	}

	// -------------- User Data Management -----------------
	public function has_userdata($key = null)
	{
		return isset($_SESSION[$key]);
	}

	public function set_userdata($keys, $value = NULL)
	{
		if (is_array($keys)) {
			foreach ($keys as $key => $val) {
				$_SESSION[$key] = $val;
			}
		} else {
			$_SESSION[$keys] = $value;
		}
	}

	public function unset_userdata($keys)
	{
		if (is_array($keys)) {
			foreach ($keys as $key) {
				unset($_SESSION[$key]);
			}
		} else {
			unset($_SESSION[$keys]);
		}
	}

	public function userdata($key = NULL)
	{
		if (isset($key))
			return $_SESSION[$key] ?? NULL;

		if (empty($_SESSION))
			return [];

		$userdata = [];
		$_exclude = array_merge(['__lava_vars'], $this->get_flash_keys());
		foreach (array_keys($_SESSION) as $k) {
			if (!in_array($k, $_exclude, TRUE)) {
				$userdata[$k] = $_SESSION[$k];
			}
		}
		return $userdata;
	}

	// -------------- Flash Data -----------------
	public function mark_as_flash($key)
	{
		if (is_array($key)) {
			foreach ($key as $k) {
				if (!isset($_SESSION[$k])) return FALSE;
			}
			$new = array_fill_keys($key, 'new');
			$_SESSION['__lava_vars'] = isset($_SESSION['__lava_vars'])
				? array_merge($_SESSION['__lava_vars'], $new)
				: $new;
			return TRUE;
		}
		if (!isset($_SESSION[$key])) return FALSE;
		$_SESSION['__lava_vars'][$key] = 'new';
		return TRUE;
	}

	public function flashdata($key = NULL)
	{
		if (isset($key)) {
			return (isset($_SESSION['__lava_vars'], $_SESSION['__lava_vars'][$key], $_SESSION[$key]) && !is_int($_SESSION['__lava_vars'][$key]))
				? $_SESSION[$key]
				: NULL;
		}
		$flashdata = [];
		if (!empty($_SESSION['__lava_vars'])) {
			foreach ($_SESSION['__lava_vars'] as $k => &$v) {
				is_int($v) OR $flashdata[$k] = $_SESSION[$k];
			}
		}
		return $flashdata;
	}

	public function set_flashdata($data, $value = NULL)
	{
		$this->set_userdata($data, $value);
		$this->mark_as_flash(is_array($data) ? array_keys($data) : $data);
	}

	public function get_flash_keys()
	{
		if (!isset($_SESSION['__lava_vars'])) return [];
		$keys = [];
		foreach (array_keys($_SESSION['__lava_vars']) as $key) {
			is_int($_SESSION['__lava_vars'][$key]) OR $keys[] = $key;
		}
		return $keys;
	}

	public function sess_destroy()
	{
		session_destroy();
	}
}
?>
