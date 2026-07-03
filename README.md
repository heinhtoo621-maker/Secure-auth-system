# Secure User Authentication System

A PHP-based secure user authentication and session management system. This project demonstrates essential backend security best practices, particularly focusing on safe password handling and validation.

## 🚀 Key Features
- **Password Hashing**: Utilizes PHP's native `password_hash()` algorithm (bcrypt) to securely encrypt credentials before storage.
- **Password Verification**: Safely authenticates user input against stored hashes using `password_verify()`.
- **Mock Session Management**: Simulates tracking the active user session upon successful login and securely handles logouts.

## 🛠️ Tech Stack & Security Concepts
- **Language**: PHP 8.x
- **Security**: Cryptographic hashing, mitigation of plaintext password storage vulnerabilities.
- **Paradigm**: Object-Oriented Programming (OOP)

## 💻 Output Example
When executed, the system safely registers a user, rejects incorrect credentials, and successfully manages a login session:

```text
--- 🔒 Secure Authentication System ---

[System] User 'admin_kyaw' registered securely.
----------------------------------------
[Auth] Login failed: Incorrect password.
[Auth] Login successful! Welcome, admin_kyaw.
[Session] Active session running for: admin_kyaw
[Auth] User 'admin_kyaw' logged out securely.
