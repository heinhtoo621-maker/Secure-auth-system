<?php

/**
 * Class User
 * Represents a user entity with a securely hashed password.
 */
class User {
    private string $username;
    private string $passwordHash;

    public function __construct(string $username, string $rawPassword) {
        $this->username = $username;
        // Securely hash the password using bcrypt (default in PHP)
        $this->passwordHash = password_hash($rawPassword, PASSWORD_DEFAULT);
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function verifyPassword(string $passwordToTest): bool {
        return password_verify($passwordToTest, $this->passwordHash);
    }
}

/**
 * Class AuthManager
 * Handles authentication logic and mock session management.
 */
class AuthManager {
    private array $usersDb = [];
    private ?string $activeSessionUser = null;

    // Mock saving user to a database
    public function registerUser(User $user): void {
        $this->usersDb[$user->getUsername()] = $user;
        echo "[System] User '{$user->getUsername()}' registered securely.\n";
    }

    // Handle login attempts
    public function login(string $username, string $password): bool {
        if (!isset($this->usersDb[$username])) {
            echo "[Auth] Login failed: User not found.\n";
            return false;
        }

        $user = $this->usersDb[$username];
        
        if ($user->verifyPassword($password)) {
            $this->activeSessionUser = $user->getUsername();
            echo "[Auth] Login successful! Welcome, {$username}.\n";
            return true;
        } else {
            echo "[Auth] Login failed: Incorrect password.\n";
            return false;
        }
    }

    public function logout(): void {
        if ($this->activeSessionUser) {
            echo "[Auth] User '{$this->activeSessionUser}' logged out securely.\n";
            $this->activeSessionUser = null;
        } else {
            echo "[Auth] No active session to log out.\n";
        }
    }
    
    public function checkSession(): void {
        if ($this->activeSessionUser) {
            echo "[Session] Active session running for: {$this->activeSessionUser}\n";
        } else {
            echo "[Session] No active session.\n";
        }
    }
}

// ==========================================
// Execution & Security Testing
// ==========================================

echo "--- 🔒 Secure Authentication System ---\n\n";

$auth = new AuthManager();

// 1. Register a new user
$newUser = new User("admin_kyaw", "SuperSecretPass123!");
$auth->registerUser($newUser);
echo "----------------------------------------\n";

// 2. Attempt login with wrong password
$auth->login("admin_kyaw", "WrongPassword456");

// 3. Attempt login with correct password
$auth->login("admin_kyaw", "SuperSecretPass123!");

// 4. Check active session
$auth->checkSession();

// 5. Secure Logout
$auth->logout();
