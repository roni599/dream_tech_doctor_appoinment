// RefreshToken.js
import axios from 'axios';
import Cookies from 'js-cookie'; // Import js-cookie

// Configure axios
axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

const refreshToken = async () => {
    const token = Cookies.get('access_token'); // Get token from cookies
    if (!token) {
        return null; // No token found, so no need to refresh
    }

    try {
        console.warn("Token expired! Refreshing...");
        const refreshResponse = await axios.post('/refresh', {}, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });

        const newToken = refreshResponse.data.access_token;
        // Store the new token in cookies
        Cookies.set('access_token', newToken, {
            secure: true,  // Secure flag for HTTPS
            sameSite: 'Strict',  // Prevent CSRF attacks
        });

        // Set the Authorization header for subsequent requests
        axios.defaults.headers['Authorization'] = `Bearer ${newToken}`;

        return newToken; // Return the new token
    } catch (error) {
        console.error('Token refresh failed:', error);
        Cookies.remove('access_token'); // Remove token from cookies if refresh fails
        window.location.href = '/login'; // Redirect to login
        return null;
    }
};

// Export the refreshToken function only
export default refreshToken;
