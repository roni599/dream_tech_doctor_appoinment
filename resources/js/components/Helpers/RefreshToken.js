import axios from 'axios';
import Cookies from 'js-cookie';

// Create an Axios instance
const api = axios.create({
    baseURL: '/api/',
    headers: {
        'Content-Type': 'application/json',
    },
});

// Add a request interceptor to add the token to the request headers
api.interceptors.request.use(
    config => {
        const token = Cookies.get('access_token'); // Retrieve token from cookies
        if (token) {
            config.headers['Authorization'] = `Bearer ${token}`;
        }
        return config;
    },
    error => Promise.reject(error)
);

// Add a response interceptor to handle token expiration
api.interceptors.response.use(
    response => response,
    async error => {
        const originalRequest = error.config;
        if (error.response.status === 401 && !originalRequest._retry) {
            originalRequest._retry = true;
            
            // Try to refresh the token
            const refreshToken = Cookies.get('access_token'); // Retrieve refresh token from cookies
            if (refreshToken) {
                console.log(refreshToken)
                try {
                    // Call your refresh API
                    const refreshResponse = await api.post('auth/refresh');
                    const { access_token } = refreshResponse.data;

                    // Save the new token in cookies
                    Cookies.set('access_token', access_token, { secure: true, sameSite: 'Strict' });

                    // Retry the original request with the new token
                    originalRequest.headers['Authorization'] = `Bearer ${access_token}`;
                    return api(originalRequest);
                } catch (refreshError) {
                    // If refreshing fails, logout or redirect
                    // console.error('Token refresh failed:', refreshError);
                    // Redirect to login or perform logout logic here
                }
            }
        }
        return Promise.reject(error);
    }
);

export default api;
