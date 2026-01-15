# Authentication System

## Features
- **Password Authentication**: Traditional username/password login
- **Google OAuth**: Login with Google account
- **Facebook OAuth**: Login with Facebook account

## Setup Instructions

### 1. Update Configuration

Edit `latest/config/define.php` and add your OAuth credentials:

```php
// Google OAuth
define("GOOGLE_CLIENT_ID", "YOUR_GOOGLE_CLIENT_ID");
define("GOOGLE_CLIENT_SECRET", "YOUR_GOOGLE_CLIENT_SECRET");

// Facebook OAuth
define("FACEBOOK_APP_ID", "YOUR_FACEBOOK_APP_ID");
define("FACEBOOK_APP_SECRET", "YOUR_FACEBOOK_APP_SECRET");
```

### 2. Get Google OAuth Credentials

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select existing one
3. Enable **Google+ API**
4. Go to **Credentials** → **Create Credentials** → **OAuth client ID**
5. Select **Web application**
6. Add authorized JavaScript origins:
   - `http://localhost`
   - `http://192.168.0.105`
   - Your production domain
7. Add authorized redirect URIs:
   - `http://localhost/latest/`
   - Your production domain callback
8. Copy **Client ID** and **Client Secret**

### 3. Get Facebook App Credentials

1. Go to [Facebook Developers](https://developers.facebook.com/)
2. Create a new app or select existing one
3. Add **Facebook Login** product
4. Configure OAuth redirect URIs in **Facebook Login** → **Settings**:
   - Add: `http://localhost/latest/`
   - Add your production domain
5. Copy **App ID** and **App Secret** from **Settings** → **Basic**

### 4. Database Setup

Ensure your `os_contacts` table has these columns:
- `google` (VARCHAR) - for Google ID
- `facebook` (VARCHAR) - for Facebook ID
- `email` (VARCHAR) - for email

```sql
ALTER TABLE os_contacts 
ADD COLUMN IF NOT EXISTS google VARCHAR(255),
ADD COLUMN IF NOT EXISTS facebook VARCHAR(255);
```

### 5. Install Dependencies

Install Google API Client (if not already installed):

```bash
cd latest
composer require google/apiclient:"^2.0"
```

## API Endpoints

### Unified Login API
**Endpoint**: `api/auth/login.php`

#### Password Login
```javascript
$.post("api/auth/login.php", {
    auth_method: "password",
    username: "user@example.com",
    password: "password123"
}, function(response) {
    if(response.success) {
        window.location.reload();
    }
}, "json");
```

#### Google Login
```javascript
$.post("api/auth/login.php", {
    auth_method: "google",
    credential: google_jwt_token
}, function(response) {
    if(response.success) {
        window.location.reload();
    }
}, "json");
```

#### Facebook Login
```javascript
$.post("api/auth/login.php", {
    auth_method: "facebook",
    facebook_id: "123456789",
    access_token: "facebook_access_token",
    email: "user@example.com",
    name: "User Name"
}, function(response) {
    if(response.success) {
        window.location.reload();
    }
}, "json");
```

## Legacy Endpoints

- `ajax/auth/action-login.php` - Password login
- `ajax/auth/action-login-google.php` - Google login
- `ajax/auth/action-login-facebook.php` - Facebook login

## Security Notes

1. **HTTPS Required**: Always use HTTPS in production for OAuth
2. **Token Verification**: All OAuth tokens are verified server-side
3. **CSRF Protection**: Implement CSRF tokens for production
4. **Rate Limiting**: Add rate limiting to prevent brute force attacks
5. **Session Security**: Use secure session settings

## Testing

### Test Password Login
1. Open login page
2. Enter username and password
3. Click "LOG IN"

### Test Google Login
1. Click "Login with Google" button
2. Select Google account
3. Grant permissions
4. Redirected to dashboard

### Test Facebook Login
1. Click "Login with Facebook" button
2. Login to Facebook
3. Grant permissions
4. Redirected to dashboard

## Troubleshooting

### Google Login Not Working
- Check if Google Client ID is correct
- Verify authorized JavaScript origins in Google Console
- Check browser console for errors
- Ensure Google API library is loaded

### Facebook Login Not Working
- Check if Facebook App ID is correct
- Verify OAuth redirect URIs in Facebook settings
- Check if Facebook app is in "Live" mode
- Ensure Facebook SDK is loaded

### User Not Found Error
- Verify user exists in database
- Check if Google/Facebook ID is stored in `os_contacts` table
- For new users, implement auto-registration or manual registration

## Auto-Registration (Optional)

To enable automatic user registration on first social login, modify the authentication handlers to create new user records when social ID is not found.

## Support

For issues or questions, contact your system administrator.
