# Bookify - Fullstack Booking App

## Overview
This project is an Airbnb clone built using the MERN stack (MongoDB, Express, React, Node.js). The application provides all the main functionalities of an Airbnb-like booking system, including user authentication, accommodation management, booking, and more.

## Table of Contents
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [Folder Structure](#folder-structure)

## Features
- **User Authentication:** Register and login functionality.
- **Account Management:** Users can manage their account information.
- **Accommodation Management:**
  - Add new places/accommodations.
  - Edit existing places/accommodations.
  - Delete photos and select main/cover photos for a place.
  - List all places added by the logged-in user.
  - Display details of a single place from the places list.
- **Booking Management:**
  - Users can book a place.
  - View all bookings made by the user.
  - View details of a specific booking.

## Technologies Used
- **Frontend:** React, Axios, React Router
- **Backend:** Node.js, Express.js, JWT for authentication
- **Database:** MongoDB with Mongoose
- **Others:** Multer for image upload, Bcrypt for password hashing

## Installation

### Prerequisites
- Node.js (v14 or higher)
- MongoDB

### Steps
1. **Clone the repository:**
   ```bash
   git clone https://github.com/sheikhDipta003/UndergradProjects.git
   cd "Build a Fullstack Booking App  - mongo, express, react/bookify"
   ```

2. **Backend Setup:**
   ```bash
   cd api
   npm install
   ```

   - Create a `.env` file in the `backend` directory and add your environment variables:
     ```env
     MONGO_URL=your_mongodb_uri
     ```

   - Start the backend server:
     ```bash
     nodemon index.js
     ```

3. **Frontend Setup:**
   ```bash
   cd ../client
   npm install
   ```

   - Start the frontend server:
     ```bash
     npm run dev
     ```

4. **Access the application:**
   - Open your browser and go to `http://localhost:5173`.

## Usage
- **Register and login** to create an account.
- **Manage your account** information from the profile page.
- **Add new places** by providing details and uploading photos.
- **Edit or delete** existing places.
- **View all places** you have added.
- **Book a place** and manage your bookings.

## Folder Structure
```
airbnb-clone/
├── api/
│   ├── models/
│   ├── uploads/
│   ├── .env
│   ├── index.js
│   └── package.json
└── client/
    ├── src/
    │   ├── assets/
    │   ├── components/
    │   ├── pages/
    │   ├── App.jsx
    │   └── main.jsx
    ├── public/
    └── package.json
```
