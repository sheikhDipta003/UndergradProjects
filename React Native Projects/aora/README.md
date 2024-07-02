# Aora

Welcome to the Aora! This mobile application allows users to browse, search, and create video posts. Users can also log in, sign up, and log out. Bookmarking features are planned but not yet implemented.

## Features

- **Browse Videos**: Discover trending and new video posts.
- **Search Videos**: Search for videos using keywords.
- **Create Video Posts**: Upload and share your own video content.
- **User Authentication**: Log in, sign up, and log out functionality.
- **Bookmarking**: (Planned) Save your favorite videos for later viewing.

## Technologies Used

- **React Native**: For building the mobile application.
- **Expo**: For developing, building, and deploying the app.

## Getting Started

### Prerequisites

- Node.js
- Expo CLI
- A code editor (e.g., VS Code)

### Installation

1. Install dependencies:
    ```bash
    npm install
    ```

2. Start the Expo Development server:
    ```bash
    npx expo start
    ```

3. Scan the QR code using the Expo Go app on your mobile device to run the application.

## Folder Structure

- **/app**: Routes, Layouts.
- **/assets**: Image, video, and other media assets.
- **/components**: Reusable React components.
- **/constants**: js files containing import statemtents for cleaner import in the jsx files.
- **/lib**: API service calls to [appwrite](https://appwrite.io) and other utility functions.
- **/context**: Maintaining a global state for the logged-in user.

