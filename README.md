# EMERGENCY_HELP_HUB

## Short Description

Emergency Help Hub is a centralized web-based emergency service management platform designed to connect citizens, emergency service providers, organizations, and administrators. The system manages emergency requests, service provider coordination, organizational support, fund management, and notification services through a role-based MVC web application.

---

## Introduction

Emergency situations often involve delays in communication, lack of coordination, and difficulty in accessing the right emergency services at the right time. Traditional emergency response systems may not provide a centralized platform for citizens, service providers, organizations, and administrators to communicate and coordinate effectively.

Emergency Help Hub is developed to address these challenges by providing a centralized web-based platform where citizens can request emergency assistance, service providers can respond to requests, organizations can provide support and manage resources, and administrators can monitor and manage the overall emergency response workflow through a role-based MVC system.

---

## Background Study

Existing emergency service systems are often fragmented across different organizations and service providers, making it difficult to track emergency requests, coordinate responses, and manage available resources efficiently. The lack of a centralized platform can lead to communication gaps and delays in emergency response.

A web-based emergency management system can improve communication, reduce response time, and support better coordination and resource management.

This project focuses on developing a secure, centralized, role-based web application using PHP, MySQL, MVC architecture, authentication, session management, and database management techniques. The system is designed to provide a coordinated platform for citizens, emergency service providers, organizations, and administrators to manage emergency-related activities efficiently.

---

## ER Diagram

![ER Diagram](assets/documentation/er-diagram.png)

---

# Database Normalization

## 1. Citizens → Emergency Requests

**Relation:** One-to-Many

**UNF:**

`citizen_id, name, phone, request_id, service_type, status`

**1NF:** No multivalued attributes

`citizen_id, name, phone, request_id, service_type, status`

---

## 2. Service Providers → Emergency Requests

**Relation:** One-to-Many

**UNF:**

`provider_id, provider_name, service_type, request_id, service_type, status`

**1NF:** No multivalued attributes

`provider_id, provider_name, service_type, request_id, status`

---

## 3. Service Providers → Provider Availability

**Relation:** One-to-Many

**UNF:**

`provider_id, provider_name, service_type, availability_id, availability_status`

**1NF:** No multivalued attributes

`provider_id, provider_name, service_type, availability_id, availability_status`

---

## 4. Service Providers → Service Areas

**Relation:** One-to-Many

**UNF:**

`provider_id, provider_name, service_type, area_id, base_area, covered_areas`

**1NF:** Multivalued Attribute: `covered_areas`

`provider_id, provider_name, service_type, area_id, base_area, area_name`

---

## 5. Organizations → Organization Providers

**Relation:** One-to-Many

**UNF:**

`organization_id, organization_name, status, organization_provider_id, provider_name`

**1NF:** No multivalued attributes

`organization_id, organization_name, status, organization_provider_id, provider_name`

---

## 6. Organizations → Organization Services

**Relation:** One-to-Many

**UNF:**

`organization_id, organization_name, status, service_id, service_name`

**1NF:** No multivalued attributes

`organization_id, organization_name, status, service_id, service_name`

---

## 7. Organizations → Organization Donations

**Relation:** One-to-Many

**UNF:**

`organization_id, organization_name, status, donation_id, amount`

**1NF:** No multivalued attributes

`organization_id, organization_name, status, donation_id, amount`

---

## 8. Citizens → Organization Reviews

**Relation:** One-to-Many

**UNF:**

`citizen_id, name, phone, review_id, rating`

**1NF:** No multivalued attributes

`citizen_id, name, phone, review_id, rating`

---

## 9. Organization Providers → Organization Reviews

**Relation:** One-to-Many

**UNF:**

`organization_provider_id, provider_name, review_id, rating`

**1NF:** No multivalued attributes

`organization_provider_id, provider_name, review_id, rating`

---

## 10. Organizations → Organization Reviews

**Relation:** One-to-Many

**UNF:**

`organization_id, organization_name, status, review_id, rating`

**1NF:** No multivalued attributes

`organization_id, organization_name, status, review_id, rating`

---

## 11. Admin → Emergency Requests

**Relation:** One-to-Many

**UNF:**

`admin_id, name, request_id, citizen_id, service_type, status`

**1NF:** No multivalued attributes

`admin_id, name, request_id, citizen_id, service_type, status`

---

## 12. Admin → Organization Donations

**Relation:** One-to-Many

**UNF:**

`admin_id, name, donation_id, organization_id, amount`

**1NF:** No multivalued attributes

`admin_id, name, donation_id, organization_id, amount`

---

# Finalized Database Tables

1. `citizens`
   `citizen_id, name, phone`

2. `providers`
   `provider_id, provider_name, service_type`

3. `emergency_requests`
   `request_id, citizen_id, provider_id, admin_id, service_type, status`

4. `provider_availability`
   `availability_id, provider_id, availability_status`

5. `provider_service_areas`
   `area_id, provider_id, base_area`

6. `service_areas`
   `area_id, area_name`

7. `organizations`
   `organization_id, organization_name, status`

8. `organization_providers`
   `organization_provider_id, organization_id, provider_name`

9. `organization_services`
   `service_id, organization_id, service_name`

10. `organization_donations`
    `donation_id, organization_id, amount`

11. `organization_reviews`
    `review_id, citizen_id, organization_provider_id, organization_id, rating`

12. `admin`
    `admin_id, name`

13. `admin_notifications`
    `admin_id, subject`

---

# Use Case Diagram

![Use Case Diagram 1](assets/documentation/use-case-diagram-1.png)

![Use Case Diagram 2](assets/documentation/use-case-diagram-2.png)

---

# UI Design (Figma/Sketch)

The user interface was designed to provide a simple, accessible, and role-based experience for all system users.

![UI Design 1](assets/documentation/ui-1.png)

![UI Design 2](assets/documentation/ui-2.png)

![UI Design 3](assets/documentation/ui-3.png)

![UI Design 4](assets/documentation/ui-4.png)

---

# Types of Users

1. **Admin (23-54308-3)**
2. **Organization (23-54172-3)**
3. **Emergency Service Provider (23-54453-3)**
4. **Citizen (23-54171-3)**

---

# Common Features (Available to All Users)

## Authentication

1. Login to the system
2. Logout from the system
3. User registration

## Account Management

1. Change or reset password
2. Manage profile information (view, edit, delete)

## Dashboard

1. Access a personalized dashboard after login

---

# Specific Features by User Type

## Admin (23-54308-3)

1. **Monitor overall system activities:**
   Monitor citizens, emergency service providers, organizations, and emergency requests.

2. **Manage notifications and announcements:**
   Create and manage important system notifications and announcements.

3. **Review and manage fund requests:**
   Review organization fund requests and approve or reject them.

---

## Organization (23-54172-3)

1. **Review and rate emergency service provider records:**
   Review emergency service provider information and provide ratings and reviews.

2. **Coordinate immediate emergency support:**
   Coordinate and provide appropriate support during emergency situations.

3. **Manage fund support activities:**
   Manage and coordinate fund-related support activities.

---

## Emergency Service Provider (23-54453-3)

1. **Manage vehicle information and availability:**
   Manage emergency service vehicles and their availability.

2. **Manage service time and route information:**
   Manage service schedules and route information.

3. **Manage service range and location coverage:**
   Manage service areas and location coverage.

---

## Citizen (23-54171-3)

1. **Manage citizen profile information:**
   View and update citizen profile information.

2. **Submit emergency service requests:**
   Submit requests for required emergency services.

3. **Provide emergency details:**
   Provide emergency details, including wheelchair requirements and injury level.

---

# Technologies Used

* **Frontend:** HTML, CSS, JavaScript
* **Backend:** PHP
* **Database:** MySQL
* **Architecture:** MVC (Model-View-Controller)
* **Authentication:** Session-based authentication
* **Database Connectivity:** MySQLi
* **Development Environment:** XAMPP

