# MEP Device Management System

A modern system for managing restaurant hardware devices with QR code scanning functionality. This system allows customers to scan a QR code on a device to access information, manuals, and report issues.

## Project Structure

The project consists of two main parts:

1. **Backend (Laravel)**: Models and database structure for the device management system.
2. **Frontend (Vue.js)**: A single-page application for displaying device information and reporting issues.

## Backend

The backend is built with Laravel and includes the following models:

- **Device**: Represents a physical device with a QR code.
- **Product**: Represents a product type that devices belong to.
- **Customer**: Represents a customer who owns devices.
- **Ticket**: Represents an issue report for a device.
- **TicketAttachment**: Represents a file attached to a ticket.
- **TicketComment**: Represents a comment on a ticket.
- **EngineeringNote**: Represents technical notes for a device.
- **Manual**: Represents a manual document for a device or product.
- **Category**: Represents a category for organizing devices and products.
- **User**: Represents a user of the system (admin, technician, etc.).

### Database Structure

The database structure is defined in the migrations. It includes all the necessary tables and relationships for the models.

## Frontend

The frontend is built with Vue.js and includes the following features:

- **Device Information**: Displays basic information about a device, including warranty status.
- **Manuals**: Displays available manuals for a device.
- **Issue Reporting**: Allows users to report issues with a device.

### Running with Docker

The project is containerized using Docker and can be run with Docker Compose:

1. Make sure you have Docker and Docker Compose installed on your system.

2. Clone the repository and navigate to the project directory:
   ```
   git clone <repository-url>
   cd mep-redesign
   ```

3. Start the containers:
   ```
   docker-compose up -d
   ```

4. The application will be available at:
   - Frontend: http://localhost:3000/qr?code=YOUR_QR_CODE
   - Backend API: http://localhost:8000/api
   - phpMyAdmin: http://localhost:8080 (username: mep_user, password: mep_password)

5. To stop the containers:
   ```
   docker-compose down
   ```

### Running the Frontend (Without Docker)

To run the frontend locally without Docker:

1. Navigate to the `frontend` directory:
   ```
   cd frontend
   ```

2. Install dependencies:
   ```
   npm install
   ```

3. Start the development server:
   ```
   npm run dev
   ```

4. Open your browser and navigate to `http://localhost:3000/qr?code=YOUR_QR_CODE` to see the device information page.

## Improvements from the Original System

This redesign includes several improvements over the original system:

1. **Modern Database Structure**: The database structure has been redesigned to be more flexible and easier to maintain.
2. **Improved User Interface**: The frontend has been redesigned with a modern, responsive interface.
3. **Better Organization**: Devices and products can be categorized for better organization.
4. **Enhanced Ticket System**: The ticket system includes attachments and comments for better communication.
5. **Comprehensive Documentation**: Manuals can be associated with both devices and products.

## Future Enhancements

Potential future enhancements for the system:

1. **User Authentication**: Add user authentication for customers and technicians.
2. **Admin Dashboard**: Create an admin dashboard for managing devices, products, and tickets.
3. **Email Notifications**: Send email notifications for ticket updates.
4. **Mobile App**: Develop a mobile app for scanning QR codes and reporting issues.
5. **Analytics**: Add analytics for tracking device issues and customer satisfaction.
