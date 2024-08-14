How to run

There are 2 folders named weather-app and weather-app-backend

weather-app-backend
1. Navigate to the weather-app-backend folder.
2. Run composer install to install the necessary PHP dependencies.
3. Open .env.example and create a new .env file.
4. Start the server by running php artisan serve.

weather-app
1. Navigate to the weather-app folder.
2. Run npm run dev to start the development server.
3. Open the provided link in your browser to access the weather app.
____________________________________________________________________________

Please provide explanation on why your UI and UX implementation and code implementation is the best.

I created a separate front-end and backend on this app so that it:

• Maintain separation of concerns, making development and maintenance easier.
• Allows independent scaling if front-end and back-end to handle varying loads
• Facilitates separate deployment, reducing downtime and allowin for flexible updates
• Isolates cloent-side and server-side components, improving security measures

For the Back-end (Laravel)
• I create apiKeys inside app.php. Storing sensitive information like API keys in configuration files follows best practices for application security
• Create separate controllers for Place Search and Weather retrieval. Each controller focuses on a specific responsibility and makes codebase more organized. It also makes it reusable.
• I created a laravel Validation to ensure that data meets specific criteria before processing. It also prevents invalid or malicious data from entering the application.
• I used guzzle tool for managing the OpenWeatherMap and geoapify API.


For the Front End (Nuxt.js, tailwind, shadcn) 

User Experience 
• It has simple and straightforward interface. Users can search and view weather updates with minimal effort, making the app accessible even for those with limited technical skills.
• The search feature with autofill suggestions streamlines the user experience. By focusing on places in Japan, the app ensures users can quickly find relevant locations without navigating through unnecessary options.
• Upon selecting a place, users instantly receive weather information. This responsiveness enhances user satisfaction by providing quick and relevant results, minimizing wait times.
• The app’s design prioritizes clarity by displaying current weather conditions alongside short-term forecasts (3, 6, 9, and 12 hours). This approach prevents information overload and allows users to easily understand weather patterns at a glance.
• The app features a responsive design, ensuring that it displays optimally on mobile devices.

Code
• I used tailwind css for rapid styling, consistency and reducing the need for custom CSS
• I used shadcn for customizable and reusable components that can accelerate development. It also works seamlessly with Tailwind CSS.
• My code design utilizes custom components to minimize repetitive code. By centralizing component management, any customizations are applied consistently across the application, which helps maintain a clean and easily understandable codebase.


