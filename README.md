# FoodSaver — Management Web Application for Food Leftovers

> A Laravel-based web application connecting food vendors with consumers to reduce food waste in Malaysia.

---

## Group Members

**Course:** BIIT 2305 — Web Application Development
**Section:** 5
**Instructor:** Dr. Najhan bin Muhamad Ibrahim

1. Azizul Hakim bin Awang Abdul Rahim — 2419087
2. Muhammad Farihin bin Johar — 2410499
3. Nadhiratul Insyirah binti Esmadi — 2411198
4. Naufa binti Mohd Yazid — 2413304

---

## Table of Contents

1. [Introduction](#11-introduction)
2. [Problem Description](#12-problem-description)
3. [Project Objective](#13-project-objective)
4. [Project Scope](#14-project-scope)
5. [Constraints](#15-constraints)
6. [Project Stages](#16-project-stages)
7. [Significance of the Project](#17-significance-of-the-project)
8. [ERD](#18-entity-relationship-diagram-erd)
9. [Sequence Diagram](#19-sequence-diagram)
10. [Summary](#110-summary)
11. [References](#111-references)

---

## 1.1 Introduction

The proposed project is a Management Web Application for Food Leftovers using the Laravel framework. This application functions as a centralized marketplace connecting food businesses such as restaurants, food companies, and hotels, with consumers looking for cheaper or free food options. To ensure a flexible system, the app will be built using Laravel MVC Framework, featuring PHP Artisan, Blade templating engine, Eloquent ORM, etc. Key features include user authentication for both vendors and buyers, CRUD functionalities for food listings, and interactive interface to promote sustainability and reduce food wastage while ensuring full adherence to Shariah Law.

---

## 1.2 Problem Description

### 1.2.1 Background of the Problem

Food waste in Malaysia has become a critical issue in Malaysia, demanding urgent attention from both the public and private sectors. According to the data from Solid Waste Management and Public Cleansing Corporation (SWCorp), up to 17,000 tonnes of food waste are recorded on a daily basis, of which approximately 4,005 tonnes are still edible, which could feed 2.9 million people three meals a day.

The proposed solution for a food surplus management is a web application, which can be accessible via both desktop and mobile browsers, that target two main user groups; Sellers including restaurant owners, hotel food and beverage department, home bakers, catering businesses, and any food related enterprise with leftovers to be distributed, & Buyers comprising the general public, low income individuals, students, and anyone searching for affordable or free food options. Both of these groups currently lack an organized platform that helps bridge their needs, and one that can help reduce food waste at the same time.

### 1.2.2 Problem Statement

As of today, the food surplus management is still decentralized and inefficient. There's still no single platform where all food vendors can redistribute their surplus effectively, making consumers often rely on fragmented social media announcements or word-of-mouth to seek for affordable or free food. They lack real-time accuracy and reliability, which in result causes massive amounts of edible food being diverted into landfills, where its decomposition releases methane, a potent greenhouse gas that causes environmental damage. The following problems have been identified with the current ways of managing surplus food:

1. Food wastage remains unaddressed — With no structured way for redistribution, huge amounts of fully edible food continue to be thrown away every day, contributing to environmental, economic, and social problems.
2. Inefficient information flow — Consumers have no real-time, centralized visibility into available food surplus from local businesses, causing missed opportunities for redistribution.
3. Resource inefficiency — Many businesses still struggle to track or manage waste because of having no integrated, data-enabled tools to handle waste distribution.

---

## 1.3 Project Objective

The main objective of this project is to develop a centralized web-based platform that connects food vendors with consumers to reduce food waste in Malaysia. By the end of this project, the following will be achieved:

1. To develop a functional food surplus management system using the Laravel MVC framework with full CRUD operations, allowing vendors to create, update, and remove food listings in real time.
2. To implement a secure user authentication system that distinguishes between two user roles: Vendors and Buyers, each with their own dashboard and access privileges.
3. To provide buyers with real-time visibility of available surplus food listings from nearby businesses, replacing inefficient word-of-mouth and social media methods.
4. To automate the food redistribution process by enabling vendors to post surplus food and buyers to browse, reserve, and claim listings through a structured and reliable platform.
5. To produce a final report documenting the system design, implementation, database structure, and overall functionality of the application.

---

## 1.4 Project Scope

### 1.4.1 Scope

The application will cover the following functionalities:

- User Registration and Authentication: Both vendors and buyers can register, log in, and manage their accounts securely using Laravel's built-in authentication system.
- Food Listing Management (CRUD): Vendors can create, read, update, and delete their food surplus listings, including details such as food name, quantity, price (or free), expiry time, and pickup location.
- Buyer Browsing and Reservation: Buyers can view all available listings, filter by category or location, and reserve food items through the platform.
- Role-Based Access Control: The system will differentiate between Vendor and Buyer roles, ensuring each user only accesses features relevant to their role.
- Admin Panel: A basic admin interface to monitor users and listings, and remove inappropriate content.

Note: The application will NOT cover payment gateway integration, mobile app development, or delivery logistics in this phase.

### 1.4.2 Targeted User

Vendors: Restaurant owners, hotel F&B departments, home bakers, caterers, and food businesses with surplus food.

Buyers: General public, low-income individuals, university students, and anyone seeking affordable or free food.

Admin: System administrator responsible for managing platform content and user accounts.

Age Group: Primarily 18–50 years old, covering students, working adults, and business owners.

### 1.4.3 Specific Platform

Software Requirements:

- Framework: Laravel 10.x (PHP 8.1+)
- Frontend: Blade Templating Engine, HTML, CSS, Bootstrap 5
- Database: MySQL
- Local Server: XAMPP / Laravel Herd
- Version Control: GitHub
- Code Editor: Visual Studio Code

Hardware Requirements:

- A computer with at least 8GB RAM and a modern processor for development purposes.
- A stable internet connection for GitHub collaboration and deployment.

Limitations and Solutions:

- If university lab computers do not have Laravel pre-installed, the team will use personal laptops with XAMPP and Composer configured locally.
- All code is managed via a shared GitHub repository to ensure consistent version control across all group members.

---

## 1.5 Constraints

Several constraints have been identified that may impact the development and execution of this project:

- Time Constraints: The development timeline is exceptionally tight, restricted to a mere 3-week window. This necessitates a highly accelerated and agile approach to the Software Development Life Cycle (SDLC), prioritizing only core functionalities to ensure timely delivery.
- Budget Limitations: Operating on a zero budget, the project relies entirely on open-source tools (Laravel, MySQL) and local servers (e.g., XAMPP/Laragon) instead of paid cloud hosting.
- Technical Constraints: Due to time and hosting limits, complex real-time features (e.g., live GPS, WebSockets) will be substituted with simpler alternatives like basic AJAX polling.
- Users' Commitment for Testing: Securing real food vendors for testing may be difficult. To overcome this, the team will use realistic mock data to demonstrate the system's functionality.

---

## 1.6 Project Stages

Given the accelerated 3-week timeline, the project milestones have been heavily compressed to focus on rapid delivery.

Phase 1 — Planning, Design & Setup (Week 1)
- Project proposal, database schema, UI wireframes, and Laravel setup.

Phase 2 — Core Development Part 1 (Week 1)
- Database migration, Authentication, and Vendor (Seller) module CRUD.

Phase 3 — Core Development Part 2 (Week 2)
- Consumer module and search/reservation functionalities.

Phase 4 — Testing & Debugging (Week 3)
- System testing, bug fixing, and ensuring mobile responsiveness.

Phase 5 — Finalization (Week 3)
- Project report, user manual, and final presentation preparation.

---

## 1.7 Significance of the Project

The proposed Management Web Application for Food Leftovers gives many benefits in terms of environment, economy, and society. This system provides a centralized platform that helps reduce food waste in a more organized and efficient way. The benefits for each user group are explained below:

### Vendors (Sellers)

- Reduce Financial Loss
  Restaurant owners, hotels, caterers, and food businesses can sell leftover food instead of throwing it away. This helps them recover some of their costs and reduce losses.

- Improve Business Image and Responsibility
  By joining this platform, businesses can show that they care about the environment and the community. This can improve their reputation and attract customers who support sustainable practices.

- Better Waste Management
  Vendors can keep track of their leftover food through the system. The recorded data can help them manage inventory better and reduce food overproduction in the future.

- Support Islamic Values
  For Muslim-owned businesses, reducing food waste is in line with Islamic teachings such as avoiding waste (Israf), being responsible (Khalifah), and helping the community.

### Buyers (Consumers)

- Affordable Food for Everyone
  The platform helps the public, especially students and low-income groups, to buy quality food at cheaper prices.

- Easy Access to Information
  Buyers can quickly see available leftover food nearby through real-time updates instead of depending on social media or word-of-mouth information.

- Simple and Convenient Process
  Users can easily browse, reserve, and collect food through a user-friendly system with secure accounts.

### Environment and Community

- Reduce Environmental Pollution
  Reducing food waste sent to landfills can lower methane gas emissions, which contribute to climate change.

- Support Sustainability Efforts
  This project helps Malaysia reduce food waste and supports national efforts to create a cleaner and more sustainable environment.

---

## 1.8 Entity Relationship Diagram (ERD)

```
+----------------+          +------------------+          +----------------+
|     users      |          |  food_listings   |          |  reservations  |
+----------------+          +------------------+          +----------------+
| id (PK)        |1       N | id (PK)          |1       N | id (PK)        |
| name           |----------| vendor_id (FK)   |----------| listing_id(FK) |
| email          |          | title            |          | buyer_id (FK)  |
| password       |          | description      |          | status         |
| role           |          | quantity         |          | reserved_at    |
| phone          |          | price            |          | created_at     |
| address        |          | category         |          | updated_at     |
| created_at     |          | expiry_time      |          +----------------+
| updated_at     |          | pickup_location  |
+----------------+          | image            |
                            | status           |
                            | created_at       |
                            | updated_at       |
                            +------------------+

                  +----------------+
                  |   categories   |
                  +----------------+
                  | id (PK)        |
                  | name           |
                  | created_at     |
                  | updated_at     |
                  +----------------+
```

Relationships:
- A User (vendor) can have many Food Listings (one-to-many)
- A Food Listing can have many Reservations (one-to-many)
- A User (buyer) can make many Reservations (one-to-many)
- A Food Listing belongs to one Category (many-to-one)

---

## 1.9 Sequence Diagram

### Vendor — Post a Food Listing

```
Vendor          Browser           Laravel Router      Controller         Database
  |                |                    |                  |                |
  |-- Login ------>|                    |                  |                |
  |                |-- POST /login ---->|                  |                |
  |                |                   |-- AuthController->|                |
  |                |                   |                  |-- Query ------->|
  |                |                   |                  |<-- User Data ---|
  |<-- Dashboard --|                   |                  |                |
  |                |                   |                  |                |
  |-- Add Listing->|                   |                  |                |
  |                |-- POST /listings->|                  |                |
  |                |                   |-- ListingController>|             |
  |                |                   |                  |-- Insert ------>|
  |                |                   |                  |<-- Success -----|
  |<-- Confirmation|                   |                  |                |
```

### Buyer — Browse and Reserve Food

```
Buyer           Browser           Laravel Router      Controller         Database
  |                |                    |                  |                |
  |-- Browse ----->|                    |                  |                |
  |                |-- GET /listings -->|                  |                |
  |                |                   |-- ListingController>|             |
  |                |                   |                  |-- Query ------->|
  |                |                   |                  |<-- Listings ----|
  |<-- View List --|                   |                  |                |
  |                |                   |                  |                |
  |-- Reserve ---->|                   |                  |                |
  |                |-- POST /reserve ->|                  |                |
  |                |                   |-- ReservationController>|         |
  |                |                   |                  |-- Insert ------>|
  |                |                   |                  |<-- Success -----|
  |<-- Confirmation|                   |                  |                |
```

---

## 1.10 Summary

The Management Web Application for Food Leftovers is developed to help reduce food waste in Malaysia, where large amounts of edible food are thrown away every day. The system is built using the Laravel MVC framework and provides a real-time platform that connects food vendors with consumers looking for affordable food.

This application improves the current system by replacing unorganized methods such as social media sharing and word-of-mouth communication with a centralized and secure platform. Features such as CRUD functions and user authentication help make the system more organized and reliable.

Overall, this project is a practical technology solution that helps reduce environmental problems, supports vendors and low-income buyers financially, and promotes Islamic values related to responsible resource management and community welfare.

---

## 1.11 References

Anon. (2022, February 15). Malaysia throws away 17,000 tonnes of food daily. The Malaysian Reserve. https://themalaysianreserve.com/2022/02/15/malaysia-throws-away-17000-tonnes-of-food-daily/

Zainal, F. (2021, May 20). Daily food waste staggering. The Star. https://www.thestar.com.my/news/nation/2021/05/20/daily-food-waste-staggering

The Lost Food Project. (n.d.). What we do. https://www.thelostfoodproject.org/what-we-do/

---

> Repository: BIIT 2305 — Web Application Development | Section 5
> Last Updated: May 2026
