# Weather App

## How to Run

### weather-app-backend
1. Navigate to the `weather-app-backend` folder.
2. Run `composer install` to install the necessary PHP dependencies.
3. Open `.env.example` and create a new `.env` file.
4. Start the server by running `php artisan serve`.

### weather-app
1. Navigate to the `weather-app` folder.
2. Run `npm run dev` to start the development server.
3. Open the provided link in your browser to access the weather app.

## Explanation of UI, UX, and Code Implementation

### Front-End and Back-End Separation

- **Separation of Concerns:** Keeps development and maintenance tasks distinct and more manageable.
- **Independent Scaling:** Allows scaling of the front-end and back-end independently to handle varying loads.
- **Separate Deployment:** Facilitates flexible updates and reduces downtime.
- **Improved Security:** Isolates client-side and server-side components to enhance security measures.

### Back-End (Laravel)

- **API Key Management:** API keys are stored in `app.php` for secure management, following best practices for application security.
- **Separate Controllers:** Controllers for Place Search and Weather Retrieval focus on specific responsibilities, improving code organization and reusability.
- **Laravel Validation:** Ensures data meets criteria before processing, preventing invalid or malicious data entry.
- **Guzzle Integration:** Used for managing API requests to OpenWeatherMap and Geoapify, providing robust API handling.

### Front-End (Nuxt.js, Tailwind CSS, ShadCN)

#### User Experience

- **Simple Interface:** Offers an easy-to-use interface for searching and viewing weather updates, accessible even to users with limited technical skills.
- **Autofill Suggestions:** Streamlines the search experience by focusing on places in Japan, helping users find relevant locations quickly.
- **Instant Weather Information:** Provides immediate weather updates upon place selection, enhancing user satisfaction and reducing wait times.
- **Clear Design:** Displays current weather and short-term forecasts (3, 6, 9, and 12 hours) to prevent information overload and simplify understanding.
- **Responsive Design:** Ensures optimal display and usability across mobile devices.

#### Code

- **Tailwind CSS:** Facilitates rapid styling, ensures consistency, and reduces the need for custom CSS.
- **ShadCN:** Provides customizable and reusable components that accelerate development and integrate seamlessly with Tailwind CSS.
- **Custom Components:** Utilizes custom components to minimize repetitive code, centralize management, and maintain a clean, easily understandable codebase.

