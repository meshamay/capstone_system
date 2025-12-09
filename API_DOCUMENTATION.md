# Capstone System Backend API Documentation

## Base URL
```
http://localhost:8000/api
```

## Authentication
The API uses Laravel Sanctum for authentication. After login/register, include the token in the Authorization header:
```
Authorization: Bearer {your-token}
```

## Endpoints

### Authentication

#### Register
- **POST** `/register`
- Body: `name`, `email`, `password`, `password_confirmation`, `phone` (optional), `address` (optional), `barangay` (optional)
- Returns: `user`, `token`

#### Login
- **POST** `/login`
- Body: `email`, `password`
- Returns: `user`, `token`

#### Logout
- **POST** `/logout` (authenticated)
- Returns: Success message

#### Get Current User
- **GET** `/me` (authenticated)
- Returns: Current user data

#### Update Profile
- **PUT** `/profile` (authenticated)
- Body: `name`, `phone`, `address`, `barangay`, `profile_photo` (file)
- Returns: Updated user data

#### Change Password
- **PUT** `/change-password` (authenticated)
- Body: `current_password`, `password`, `password_confirmation`
- Returns: Success message

---

### Complaints

#### List Complaints
- **GET** `/complaints` (authenticated)
- Query params: `status`, `search`, `page`
- Returns: Paginated complaints

#### Create Complaint
- **POST** `/complaints` (authenticated)
- Body: `complaint_type`, `subject`, `description`, `location` (optional), `attachments[]` (files)
- Returns: Created complaint

#### Get Complaint
- **GET** `/complaints/{id}` (authenticated)
- Returns: Complaint details

#### Update Complaint
- **PUT** `/complaints/{id}` (authenticated)
- Body: `complaint_type`, `subject`, `description`, `location`, `status` (admin only), `admin_response` (admin only)
- Returns: Updated complaint

#### Delete Complaint
- **DELETE** `/complaints/{id}` (authenticated)
- Returns: Success message

---

### Document Requests

#### List Document Requests
- **GET** `/documents` (authenticated)
- Query params: `status`, `search`, `page`
- Returns: Paginated document requests

#### Create Document Request
- **POST** `/documents` (authenticated)
- Body: `document_type`, `purpose`, `required_info` (array)
- Returns: Created document request with tracking number

#### Get Document Request
- **GET** `/documents/{id}` (authenticated)
- Returns: Document request details

#### Update Document Request
- **PUT** `/documents/{id}` (authenticated, admin only)
- Body: `status`, `fee`, `payment_status`, `remarks`
- Returns: Updated document request

#### Delete Document Request
- **DELETE** `/documents/{id}` (authenticated)
- Returns: Success message

#### Track Document (Public)
- **POST** `/documents/track`
- Body: `tracking_number`
- Returns: Document status

---

### Announcements

#### List Announcements (Public)
- **GET** `/announcements`
- Query params: `category`, `page`
- Returns: Paginated announcements

#### Get Announcement (Public)
- **GET** `/announcements/{id}`
- Returns: Announcement details

#### Create Announcement (Admin)
- **POST** `/announcements` (authenticated, admin only)
- Body: `title`, `content`, `category`, `is_pinned`, `is_active`, `published_at`, `images[]` (files)
- Returns: Created announcement

#### Update Announcement (Admin)
- **PUT** `/announcements/{id}` (authenticated, admin only)
- Body: `title`, `content`, `category`, `is_pinned`, `is_active`, `published_at`
- Returns: Updated announcement

#### Delete Announcement (Admin)
- **DELETE** `/announcements/{id}` (authenticated, admin only)
- Returns: Success message

---

### Barangay Officials

#### List Officials (Public)
- **GET** `/officials`
- Returns: List of officials

#### Get Official (Public)
- **GET** `/officials/{id}`
- Returns: Official details

#### Create Official (Admin)
- **POST** `/officials` (authenticated, admin only)
- Body: `name`, `position`, `contact`, `email`, `order`, `photo` (file)
- Returns: Created official

#### Update Official (Admin)
- **PUT** `/officials/{id}` (authenticated, admin only)
- Body: `name`, `position`, `contact`, `email`, `order`, `photo` (file)
- Returns: Updated official

#### Delete Official (Admin)
- **DELETE** `/officials/{id}` (authenticated, admin only)
- Returns: Success message

---

### Users (Admin Only)

#### List Users
- **GET** `/users` (authenticated, admin only)
- Query params: `role`, `search`, `page`
- Returns: Paginated users

#### Get User
- **GET** `/users/{id}` (authenticated, admin only)
- Returns: User details

#### Update User
- **PUT** `/users/{id}` (authenticated, superadmin only)
- Body: `name`, `email`, `role`, `is_active`
- Returns: Updated user

#### Delete User
- **DELETE** `/users/{id}` (authenticated, superadmin only)
- Returns: Success message

#### Get Stats
- **GET** `/users/stats` (authenticated, admin only)
- Returns: Statistics about users, complaints, and documents

---

## User Roles

- **user**: Regular users who can file complaints and request documents
- **admin**: Can manage all complaints, documents, announcements, and officials
- **superadmin**: Full system access including user management

## Default Credentials

### Super Admin
- Email: `superadmin@capstone.com`
- Password: `password`

### Admin
- Email: `admin@capstone.com`
- Password: `password`

### User
- Email: `john@example.com`
- Password: `password`

## Status Values

### Complaint Status
- `pending` - Newly submitted
- `in_progress` - Being reviewed/worked on
- `resolved` - Completed
- `rejected` - Not accepted

### Document Request Status
- `pending` - Newly submitted
- `processing` - Being prepared
- `ready` - Ready for pickup
- `claimed` - Received by requestor
- `rejected` - Not approved

## Error Responses

All endpoints return standard JSON error responses:

```json
{
    "message": "Error message",
    "errors": {
        "field": ["Validation error message"]
    }
}
```

HTTP Status Codes:
- `200` - Success
- `201` - Created
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `422` - Validation Error
- `500` - Server Error
