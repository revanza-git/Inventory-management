# System Inventory

© 2025 Copyright : Revanza

---

## Table of Contents
1. [Quick Start](#quick-start)
2. [System Architecture](#system-architecture)
3. [Data Flow Diagrams](#data-flow-diagrams)
4. [Approval Workflow](#approval-workflow)
5. [Database Flow Architecture](#database-flow-architecture)
6. [Requirements](#requirements)
7. [Features](#features)
8. [Database Schema](#database-schema)
9. [UI Preview](#ui-preview)
10. [Installation](#installation)
11. [Configuration](#configuration)
12. [Database Setup](#database-setup)
13. [Testing Environment](#testing-environment)
14. [Migration System](#migration-system)
15. [Seeding Initial Data](#seeding-initial-data)
16. [Storage Link](#storage-link)
17. [Running the Application](#running-the-application)
18. [Default Accounts](#default-accounts)
19. [API Authentication](#api-authentication)
20. [Production Deployment](#production-deployment)
21. [Troubleshooting](#troubleshooting)
22. [About & Contact](#about--contact)

---

## Quick Start

### Prerequisites
- PHP 8.1+ with required extensions (pdo_sqlsrv, mbstring, openssl, etc.)
- Composer 2.x
- Node.js 16+ & npm
- Microsoft SQL Server (Express or higher)
- IIS 10 (or compatible web server)

### Fast Setup (5 minutes)
```bash
# 1. Clone and install dependencies
git clone <repository-url>
cd Inventory
composer install
npm install

# 2. Configure environment
cp .env.example .env
# Edit .env with your database credentials

# 3. Generate app key and setup database
php artisan key:generate
php artisan migrate
php artisan db:seed

# 4. Create storage link and start server
php artisan storage:link
php artisan serve
```

### Access Application
- **URL**: http://localhost:8000
- **Admin Email**: admin@example.com
- **Password**: Contact administrator for credentials

For detailed setup instructions, see [Installation](#installation) section.

---

## System Architecture

### High-Level Architecture Overview

```
┌─────────────────────────────────────────────────────────────────────────────────┐
│                           SYSTEM INVENTORY ARCHITECTURE                          │
├─────────────────────────────────────────────────────────────────────────────────┤
│  ┌─────────────────┐    ┌──────────────────┐    ┌─────────────────────────────┐ │
│  │   Web Browser   │    │   Mobile Client  │    │    API Consumers           │ │
│  │   (Frontend)    │    │   (Optional)     │    │    (Third-party)           │ │
│  └─────────────────┘    └──────────────────┘    └─────────────────────────────┘ │
│           │                       │                           │                  │
│           └───────────────────────┼───────────────────────────┘                  │
│                                   │                                              │
├───────────────────────────────────┼──────────────────────────────────────────────┤
│  ┌─────────────────────────────────▼─────────────────────────────────────────┐   │
│  │                        IIS 10 WEB SERVER                                   │   │
│  │  ┌─────────────────────────────────────────────────────────────────────┐  │   │
│  │  │                    LARAVEL APPLICATION                               │  │   │
│  │  │                                                                     │  │   │
│  │  │  ┌──────────────┐  ┌─────────────┐  ┌──────────────────────────┐  │  │   │
│  │  │  │ Controllers  │  │ Middleware  │  │     API Routes            │  │  │   │
│  │  │  │              │  │             │  │     Web Routes            │  │  │   │
│  │  │  └──────────────┘  └─────────────┘  └──────────────────────────┘  │  │   │
│  │  │                                                                     │  │   │
│  │  │  ┌──────────────┐  ┌─────────────┐  ┌──────────────────────────┐  │  │   │
│  │  │  │   Models     │  │ Validators  │  │     Services             │  │  │   │
│  │  │  │   Eloquent   │  │             │  │                          │  │  │   │
│  │  │  └──────────────┘  └─────────────┘  └──────────────────────────┘  │  │   │
│  │  └─────────────────────────────────────────────────────────────────────┘  │   │
│  └─────────────────────────────────────────────────────────────────────────────┘   │
├─────────────────────────────────────────────────────────────────────────────────────┤
│  ┌─────────────────────────────────────────────────────────────────────────────┐   │
│  │                          SQL SERVER DATABASE                                 │   │
│  │                                                                             │   │
│  │  ┌──────────────┐  ┌─────────────┐  ┌──────────────────────────────────┐  │   │
│  │  │ Core Tables  │  │ Flow Tables │  │        History Tables            │  │   │
│  │  │              │  │             │  │                                  │  │   │
│  │  │ • users      │  │ • flow_in   │  │ • history_in                     │  │   │
│  │  │ • part       │  │ • flow_out  │  │ • history_out                    │  │   │
│  │  │ • secret_code│  │ • auto_ftb  │  │ • personal_access_tokens         │  │   │
│  │  │              │  │ • auto_fkb  │  │                                  │  │   │
│  │  └──────────────┘  └─────────────┘  └──────────────────────────────────┘  │   │
│  └─────────────────────────────────────────────────────────────────────────────┘   │
├─────────────────────────────────────────────────────────────────────────────────────┤
│  ┌─────────────────────────────────────────────────────────────────────────────┐   │
│  │                              FILE STORAGE                                    │   │
│  │                                                                             │   │
│  │  ┌──────────────┐  ┌─────────────┐  ┌──────────────────────────────────┐  │   │
│  │  │ Public Files │  │ Private     │  │        Document Storage          │  │   │
│  │  │              │  │ Storage     │  │                                  │  │   │
│  │  │ • Images     │  │ • Logs      │  │ • PDF Documents                  │  │   │
│  │  │ • CSS/JS     │  │ • Cache     │  │ • Digital Signatures             │  │   │
│  │  │ • Assets     │  │ • Sessions  │  │ • Photo Attachments              │  │   │
│  │  └──────────────┘  └─────────────┘  └──────────────────────────────────┘  │   │
│  └─────────────────────────────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────────────────────────────┘
```

### Technology Stack
- **Backend**: Laravel 8.x+ (PHP 8.x)
- **Database**: Microsoft SQL Server
- **Web Server**: IIS 10
- **Frontend**: Blade Templates + Bootstrap + JavaScript
- **Authentication**: Laravel Sanctum
- **File Storage**: Local Storage + Symbolic Links

---

## Data Flow Diagrams

### FTB (Form Transfer Barang) - Inbound Flow

```
┌──────────────┐    ┌───────────────┐    ┌─────────────────┐    ┌──────────────────┐
│   Supplier   │───▶│  Goods Recv.  │───▶│  Create FTB     │───▶│   Approval       │
│   Delivery   │    │  Inspection   │    │  Document       │    │   Process        │
└──────────────┘    └───────────────┘    └─────────────────┘    └──────────────────┘
                                                │                          │
                                                ▼                          │
┌──────────────┐    ┌───────────────┐    ┌─────────────────┐               │
│  Update      │◀───│  Stock        │◀───│  Part Catalog   │               │
│  Inventory   │    │  Addition     │    │  Management     │               │
└──────────────┘    └───────────────┘    └─────────────────┘               │
       │                                                                   │
       ▼                                                                   │
┌──────────────┐    ┌───────────────┐    ┌─────────────────┐               │
│  History     │    │  Document     │    │  Auto Number    │               │
│  Tracking    │    │  Storage      │    │  Generation     │               │
└──────────────┘    └───────────────┘    └─────────────────┘               │
                                                                           │
                    ┌─────────────────────────────────────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────────────────────────────────────────────┐
│                          4-STAGE APPROVAL WORKFLOW                               │
│                                                                                 │
│  ┌─────────────┐   ┌─────────────┐   ┌─────────────┐   ┌─────────────────────┐  │
│  │   Stage 1   │──▶│   Stage 2   │──▶│   Stage 3   │──▶│      Stage 4        │  │
│  │    User     │   │    Admin    │   │    Head     │   │      Master         │  │
│  │   Level     │   │   Level     │   │   Level     │   │      Level          │  │
│  └─────────────┘   └─────────────┘   └─────────────┘   └─────────────────────┘  │
│        │                 │                 │                      │             │
│        ▼                 ▼                 ▼                      ▼             │
│  ┌─────────────┐   ┌─────────────┐   ┌─────────────┐   ┌─────────────────────┐  │
│  │ Digital     │   │ Digital     │   │ Digital     │   │ Digital             │  │
│  │ Signature   │   │ Signature   │   │ Signature   │   │ Signature           │  │
│  │ + Reason    │   │ + Reason    │   │ + Reason    │   │ + Reason            │  │
│  └─────────────┘   └─────────────┘   └─────────────┘   └─────────────────────┘  │
└─────────────────────────────────────────────────────────────────────────────────┘
```

### FKB (Form Keluar Barang) - Outbound Flow

```
┌──────────────┐    ┌───────────────┐    ┌─────────────────┐    ┌──────────────────┐
│  Department  │───▶│  Stock        │───▶│  Create FKB     │───▶│   Approval       │
│  Request     │    │  Verification │    │  Document       │    │   Process        │
└──────────────┘    └───────────────┘    └─────────────────┘    └──────────────────┘
                                                │                          │
                                                ▼                          │
┌──────────────┐    ┌───────────────┐    ┌─────────────────┐               │
│  Stock       │◀───│  Inventory    │◀───│  Stock Level    │               │
│  Reduction   │    │  Update       │    │  Check          │               │
└──────────────┘    └───────────────┘    └─────────────────┘               │
       │                                                                   │
       ▼                                                                   │
┌──────────────┐    ┌───────────────┐    ┌─────────────────┐               │
│  History     │    │  Delivery     │    │  Document       │               │
│  Tracking    │    │  Processing   │    │  Archive        │               │
└──────────────┘    └───────────────┘    └─────────────────┘               │
                                                                           │
                    ┌─────────────────────────────────────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────────────────────────────────────────────┐
│                          4-STAGE APPROVAL WORKFLOW                               │
│                         (Same as FTB Process Above)                              │
└─────────────────────────────────────────────────────────────────────────────────┘
```

---

## Approval Workflow

### Multi-Stage Approval Process

```
                          ┌─────────────────────────────────────┐
                          │        DOCUMENT SUBMISSION           │
                          │      (FTB/FKB Created)              │
                          └─────────────────────────────────────┘
                                           │
                                           ▼
    ┌─────────────────────────────────────────────────────────────────────────────────┐
    │                              STAGE 1 - USER LEVEL                                │
    │                                                                                 │
    │  ┌─────────────┐   ┌─────────────┐   ┌─────────────┐   ┌─────────────────────┐  │
    │  │ Document    │──▶│ Validation  │──▶│ Review &    │──▶│ Digital Signature   │  │
    │  │ Review      │   │ Check       │   │ Approve     │   │ + Approval Reason   │  │
    │  └─────────────┘   └─────────────┘   └─────────────┘   └─────────────────────┘  │
    └─────────────────────────────────────────────────────────────────────────────────┘
                                           │
                                           ▼
    ┌─────────────────────────────────────────────────────────────────────────────────┐
    │                             STAGE 2 - ADMIN LEVEL                                │
    │                                                                                 │
    │  ┌─────────────┐   ┌─────────────┐   ┌─────────────┐   ┌─────────────────────┐  │
    │  │ Admin       │──▶│ Technical   │──▶│ Final       │──▶│ Digital Signature   │  │
    │  │ Validation  │   │ Review      │   │ Approval    │   │ + Approval Reason   │  │
    │  └─────────────┘   └─────────────┘   └─────────────┘   └─────────────────────┘  │
    └─────────────────────────────────────────────────────────────────────────────────┘
                                           │
                                           ▼
    ┌─────────────────────────────────────────────────────────────────────────────────┐
    │                             STAGE 3 - HEAD LEVEL                                 │
    │                                                                                 │
    │  ┌─────────────┐   ┌─────────────┐   ┌─────────────┐   ┌─────────────────────┐  │
    │  │ Department  │──▶│ Budget      │──▶│ Strategic   │──▶│ Digital Signature   │  │
    │  │ Impact      │   │ Approval    │   │ Review      │   │ + Approval Reason   │  │
    │  └─────────────┘   └─────────────┘   └─────────────┘   └─────────────────────┘  │
    └─────────────────────────────────────────────────────────────────────────────────┘
                                           │
                                           ▼
    ┌─────────────────────────────────────────────────────────────────────────────────┐
    │                            STAGE 4 - MASTER LEVEL                                │
    │                                                                                 │
    │  ┌─────────────┐   ┌─────────────┐   ┌─────────────┐   ┌─────────────────────┐  │
    │  │ Final       │──▶│ Executive   │──▶│ Master      │──▶│ Digital Signature   │  │
    │  │ Authorization│   │ Review      │   │ Approval    │   │ + Completion        │  │
    │  └─────────────┘   └─────────────┘   └─────────────┘   └─────────────────────┘  │
    └─────────────────────────────────────────────────────────────────────────────────┘
                                           │
                                           ▼
                          ┌─────────────────────────────────────┐
                          │         PROCESS COMPLETION           │
                          │    • Stock Updated                  │
                          │    • History Recorded               │
                          │    • Documents Archived             │
                          │    • Notifications Sent             │
                          └─────────────────────────────────────┘

    ┌─────────────────────────────────────────────────────────────────────────────────┐
    │                             REJECTION HANDLING                                   │
    │                                                                                 │
    │  Any stage can REJECT the document, which:                                      │
    │  • Stops the approval process                                                   │
    │  • Records rejection reason                                                     │
    │  • Notifies the originator                                                      │
    │  • Allows for document revision and resubmission                               │
    └─────────────────────────────────────────────────────────────────────────────────┘
```

---

## Database Flow Architecture

### Core Data Relationships

```
    ┌─────────────────────────────────────────────────────────────────────────────────┐
    │                              CORE ENTITIES                                       │
    └─────────────────────────────────────────────────────────────────────────────────┘
                                           │
                                           ▼
    ┌─────────────────┐                ┌─────────────────┐                ┌─────────────────┐
    │     USERS       │                │      PARTS      │                │  SECRET_CODES   │
    │                 │                │                 │                │                 │
    │ • id            │                │ • idPart (PK)   │                │ • id            │
    │ • name          │                │ • part_number   │                │ • secret_code   │
    │ • email         │                │ • description   │                │ • created_at    │
    │ • role          │                │ • category      │                │                 │
    │ • digital_sign  │                │ • location      │                │                 │
    └─────────────────┘                └─────────────────┘                └─────────────────┘
                                                │
                                                │
                        ┌───────────────────────┼───────────────────────┐
                        │                       │                       │
                        ▼                       ▼                       ▼
    ┌─────────────────────────────────────────────────────────────────────────────────┐
    │                              FLOW MANAGEMENT                                     │
    └─────────────────────────────────────────────────────────────────────────────────┘
                        │                                               │
                        ▼                                               ▼
    ┌─────────────────┐                                    ┌─────────────────┐
    │  FLOW_IN_PART   │                                    │  FLOW_OUT_PART  │
    │     (FTB)       │                                    │     (FKB)       │
    │                 │                                    │                 │
    │ • id_flowInPart │                                    │ • id_flowOutPart│
    │ • idPart (FK)   │                                    │ • idPart (FK)   │
    │ • quantity      │                                    │ • quantity      │
    │ • document_no   │                                    │ • document_no   │
    │ • approval_1    │                                    │ • approval_1    │
    │ • approval_2    │                                    │ • approval_2    │
    │ • approval_3    │                                    │ • approval_3    │
    │ • approval_4    │                                    │ • approval_4    │
    │ • created_at    │                                    │ • created_at    │
    └─────────────────┘                                    └─────────────────┘
            │                                                      │
            ▼                                                      ▼
    ┌─────────────────┐                                    ┌─────────────────┐
    │   HISTORY_IN    │                                    │   HISTORY_OUT   │
    │                 │                                    │                 │
    │ • id            │                                    │ • id            │
    │ • id_flowInPart │                                    │ • id_flowOutPart│
    │ • action        │                                    │ • action        │
    │ • user_id       │                                    │ • user_id       │
    │ • timestamp     │                                    │ • timestamp     │
    │ • details       │                                    │ • details       │
    └─────────────────┘                                    └─────────────────┘

    ┌─────────────────────────────────────────────────────────────────────────────────┐
    │                            SUPPORTING TABLES                                     │
    └─────────────────────────────────────────────────────────────────────────────────┘
                        │                                               │
                        ▼                                               ▼
    ┌─────────────────┐         ┌─────────────────┐         ┌─────────────────┐
    │    AUTO_FTB     │         │    AUTO_FKB     │         │PERSONAL_ACCESS_ │
    │                 │         │                 │         │     TOKENS      │
    │ • id            │         │ • id            │         │                 │
    │ • current_no    │         │ • current_no    │         │ • id            │
    │ • prefix        │         │ • prefix        │         │ • tokenable_id  │
    │ • year          │         │ • year          │         │ • name          │
    │                 │         │                 │         │ • token         │
    └─────────────────┘         └─────────────────┘         │ • abilities     │
                                                            └─────────────────┘
```

### Data Flow Process

```
1. INBOUND FLOW (FTB):
   Parts → flow_in_part → Approvals → history_in → Stock Update

2. OUTBOUND FLOW (FKB):
   Request → flow_out_part → Approvals → history_out → Stock Reduction

3. APPROVAL TRACKING:
   Each approval stage updates the respective approval_X column
   History tables maintain complete audit trail

4. DOCUMENT NUMBERING:
   auto_ftb and auto_fkb provide sequential document numbers
   Format: PREFIX-YYYY-NNNN (e.g., FTB-2024-0001)

5. USER MANAGEMENT:
   users table manages authentication and role-based access
   personal_access_tokens enables API authentication via Laravel Sanctum

6. SECURITY:
   secret_codes table stores system-wide security codes
   Digital signatures stored with user records
```

---

## Requirements

### System Requirements
- **PHP 8.1+** with extensions:
  - pdo_sqlsrv (SQL Server driver)
  - mbstring (multibyte string support)
  - openssl (encryption)
  - tokenizer (Laravel requirement)
  - xml (XML processing)
  - ctype (character type checking)
  - json (JSON processing)
  - bcmath (precision mathematics)
  - fileinfo (file information)
- **Composer 2.x**: PHP dependency management
- **Node.js 16+** & **npm 8+**: Frontend asset compilation
- **Microsoft SQL Server 2016+** (Express, Standard, or Enterprise)
- **IIS 10+** or Apache 2.4+ (web server)
- **Windows Server 2016+** or Windows 10+ (recommended)

### Optional Tools
- **Git 2.x**: Version control and code management
- **Visual Studio Code**: Development environment
- **SQL Server Management Studio**: Database administration
- **Postman**: API testing and development

---

## Features

### Inventory Management
- **Multi-Category Inventory Tracking**
  - Electrical parts and equipment
  - Instrumentation components
  - Mechanical parts
  - Provision/Tie-in materials
  - Emergency supplies
  - Reliability equipment
  - Scrap materials
  - IT equipment
  - Department-specific inventories (Layum, Sekper, HSSE)

### Stock Control
- **Stock In/Out Management (FTB/FKB)**
  - **FTB (Form Transfer Barang)**: Inbound parts workflow
  - **FKB (Form Keluar Barang)**: Outbound parts workflow
  - Add new stock with detailed information
  - Remove stock with tracking
  - Historical stock tracking
  - Stock level monitoring
  - Old stock management
  - Auto-generated document numbers

### Document Management
- **File Attachments**
  - Support for photos (JPG, PNG)
  - PDF document storage (PO, BAST)
  - Digital signature storage
  - Document version control

### User Management
- **Role-Based Access Control**
  - Admin privileges
  - Department-specific access
  - User authentication
  - Secure login system
  - Digital signature management

### Approval System
- **Multi-level Approval Process**
  - **4-Stage Approval Workflow**:
    1. First approval (User level)
    2. Second approval (Admin level)
    3. Third approval (Head level)
    4. Fourth approval (Master level)
  - Document approval tracking
  - Digital signature integration
  - Approval reason logging
  - Time-stamped approvals

### Reporting & Analytics
- **Transaction Tracking**
  - Complete audit trail through history tables
  - Stock movement history
  - Department-wise reports
  - Date-range based filtering
  - Transaction counts and summaries
  - Approval workflow tracking

### Additional Features
- **Search & Filter**
  - Part number search
  - Category-based filtering
  - Location tracking
  - Material categorization

- **Data Validation**
  - Input validation
  - Data integrity checks
  - Error handling
  - Duplicate prevention

---

## Database Schema

### Core Tables
- **`users`**: User authentication and authorization
- **`part`**: Parts/inventory items catalog
- **`flow_in_part`**: Inbound parts flow management (FTB)
- **`flow_out_part`**: Outbound parts flow management (FKB)
- **`history_in`**: Audit trail for inbound transactions
- **`history_out`**: Audit trail for outbound transactions

### Supporting Tables
- **`auto_fkb`**: Auto-increment counter for FKB document numbers
- **`auto_ftb`**: Auto-increment counter for FTB document numbers
- **`secret_code`**: System security codes
- **`personal_access_tokens`**: API authentication tokens (Laravel Sanctum)

### Foreign Key Relationships
- `flow_in_part.idPart` → `part.idPart`
- `flow_out_part.idPart` → `part.idPart`
- `history_in.id_flowInPart` → `flow_in_part.id_flowInPart`
- `history_out.id_flowOutPart` → `flow_out_part.id_flowOutPart`

For detailed database schema documentation, see [DATABASE_SCHEMA_DOCUMENTATION.md](DATABASE_SCHEMA_DOCUMENTATION.md).

---

## Security Features

### Authentication & Authorization
- **Secure Login System**
  - Rate limiting for login attempts
  - Password hashing using bcrypt
  - Session management
  - Role-based access control
  - API token authentication (Laravel Sanctum)

### Data Protection
- **Sensitive Data Handling**
  - Encrypted database connections
  - Secure file storage
  - Input sanitization
  - XSS protection

### Security Best Practices
- **System Security**
  - Regular security updates
  - Secure password policies
  - Session timeout
  - CSRF protection
  - SQL injection prevention

### Security Recommendations
1. Change default credentials immediately after installation
2. Enable HTTPS in production
3. Regular security audits
4. Keep system and dependencies updated
5. Regular backup of data
6. Monitor system logs for suspicious activities

---

## UI Preview

### Main Dashboard
![System Inventory Dashboard](/public/sinv0.jpg)

### Inventory Management Interface
![Inventory Management](/public/sinv1.jpg)

---

## Installation
1. **Clone the repository:**
   ```bash
   git clone <your-repo-url>
   cd <your-project-directory>
   ```
2. **Install PHP dependencies:**
   ```bash
   composer install
   ```
3. **Install Node.js dependencies:**
   ```bash
   npm install
   ```

---

## Configuration
1. **Copy the example environment file (if available) or create a new `.env`:**
   ```bash
   cp .env.example .env
   ```
   If `.env.example` does not exist, create a `.env` file manually.

2. **Set your database credentials and other environment variables in `.env`:**
   ```env
   DB_CONNECTION=sqlsrv
   DB_HOST=.\SQLEXPRESS
   DB_PORT=
   DB_DATABASE=Inventory
   DB_USERNAME=sa
   DB_PASSWORD=your_password
   ```

3. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

---

## Database Setup

### Production Database
1. **Create a new database** in your SQL Server for this project.
2. **Run migrations to create tables:**
   ```bash
   php artisan migrate
   ```
   _This will create all 11 tables required for inventory, user management, and transaction tracking._

3. **Check migration status:**
   ```bash
   php artisan migrate:status
   ```

### Database Migration Files
The system includes the following migration files:
- `2019_12_14_000001_create_personal_access_tokens_table.php` - API tokens
- `2022_09_19_121239_create_part.php` - Parts catalog
- `2022_09_19_121341_create_flow_in_part.php` - Inbound workflow
- `2022_09_19_121521_create_flow_out_part.php` - Outbound workflow
- `2022_09_19_122016_add_id_to_flow_in_part.php` - Foreign keys
- `2022_09_19_122120_add_id_to_flow_out_part.php` - Foreign keys
- `2022_09_25_093114_create_users_tables.php` - User management
- `2022_09_26_103202_create_secret_code_table.php` - Security codes
- `2022_10_10_125143_create_auto_f_t_b_s_table.php` - FTB numbering
- `2022_10_10_125758_create_auto_f_k_b_s_table.php` - FKB numbering
- `2022_10_20_*` - Structure optimization migrations
- `2022_10_31_*` - History table migrations
- `2022_11_01_*` - Performance and compatibility improvements

---

## Testing Environment

### Setting Up Test Database
1. **The system includes a `.env.testing` file for testing:**
   ```env
   DB_DATABASE=inventory_test
   ```

2. **Create test database:**
   ```bash
   sqlcmd -S .\SQLEXPRESS -U sa -P your_password -Q "CREATE DATABASE inventory_test"
   ```

3. **Run migrations on test database:**
   ```bash
   php artisan migrate --env=testing
   ```

4. **Check test migration status:**
   ```bash
   php artisan migrate:status --env=testing
   ```

### Testing Migration Rollbacks
```bash
# Rollback one migration
php artisan migrate:rollback --env=testing --step=1

# Re-run migrations
php artisan migrate --env=testing
```

---

## Migration System

### Available Commands
```bash
# Run all pending migrations
php artisan migrate

# Check migration status
php artisan migrate:status

# Rollback last batch of migrations
php artisan migrate:rollback

# Rollback specific number of migration batches
php artisan migrate:rollback --step=3

# Reset all migrations (DANGEROUS - will drop all tables)
php artisan migrate:reset

# Refresh migrations (reset + migrate)
php artisan migrate:refresh

# Fresh migration (drop all tables + migrate)
php artisan migrate:fresh
```

### Migration Safety
- Always backup your database before running migrations in production
- Test migrations in the testing environment first
- Use `--step` parameter for controlled rollbacks
- Check migration status before and after operations

---

## Seeding Initial Data
1. **Edit `database/seeders/DatabaseSeeder.php`** if you want to change the default secret code or superadmin account.
2. **Run the database seeder:**
   ```bash
   php artisan db:seed
   ```
   _This will create the initial superadmin account and secret code for system access._

3. **For testing environment:**
   ```bash
   php artisan db:seed --env=testing
   ```

---

## Storage Link
If your application uses file uploads or needs access to the `storage` directory, create a symbolic link:
```bash
php artisan storage:link
```
_This allows uploaded files (such as part images or documents) to be accessible from the web interface._

---

## Running the Application
1. **Start the Laravel development server:**
   ```bash
   php artisan serve
   ```
   _This launches the backend API and web server for the inventory system._

2. **(Optional) Build frontend assets:**
   ```bash
   npm run dev
   ```
   _This compiles and serves the latest CSS and JavaScript for the user interface._

3. **Access the application:**
   Open your browser and go to [http://localhost:8000](http://localhost:8000)

---

## Default Accounts
- **Superadmin**
  - Email: `admin@example.com`
  - Password: `[Contact administrator for default password]`
- **Secret Code:** `[Contact administrator for secret code]` (hashed in the database)

_After logging in as superadmin, you can create accounts for other departments/users._

---

## API Authentication

### Laravel Sanctum
The system includes Laravel Sanctum for API authentication:

1. **Generate API tokens** for users through the application
2. **Use tokens** in API requests:
   ```bash
   curl -H "Authorization: Bearer YOUR_TOKEN" http://localhost:8000/api/endpoint
   ```

### Token Management
- Tokens are stored in the `personal_access_tokens` table
- Tokens can have abilities/scopes for fine-grained access control
- Tokens can have expiration dates
- Last used timestamps are tracked

---

## Production Deployment

### IIS Configuration
1. **Install Required Modules**:
   - URL Rewrite Module
   - PHP Manager for IIS
   - Microsoft Drivers for PHP for SQL Server

2. **Site Configuration**:
   ```xml
   <!-- web.config for Laravel on IIS -->
   <configuration>
     <system.webServer>
       <rewrite>
         <rules>
           <rule name="Laravel" stopProcessing="true">
             <match url="^(.*)$" ignoreCase="false" />
             <conditions>
               <add input="{REQUEST_FILENAME}" matchType="IsFile" negate="true" />
               <add input="{REQUEST_FILENAME}" matchType="IsDirectory" negate="true" />
             </conditions>
             <action type="Rewrite" url="index.php/{R:1}" appendQueryString="true" />
           </rule>
         </rules>
       </rewrite>
     </system.webServer>
   </configuration>
   ```

3. **Set Document Root**: Point to `/public` directory
4. **Configure PHP**: Ensure proper PHP version and extensions
5. **Set Permissions**: Grant IIS_IUSRS write access to `storage` and `bootstrap/cache`

### Environment Configuration
```bash
# Production environment settings
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Database production settings
DB_CONNECTION=sqlsrv
DB_HOST=your-sql-server
DB_DATABASE=inventory_production
DB_USERNAME=inventory_user
DB_PASSWORD=secure_password

# Cache and session configuration
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

### Security Checklist
- [ ] Update all default passwords
- [ ] Enable HTTPS with valid SSL certificate
- [ ] Configure firewall rules
- [ ] Set up database backups
- [ ] Enable audit logging
- [ ] Configure rate limiting
- [ ] Set up monitoring and alerting

### Performance Optimization
```bash
# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
npm run production
```

---

## Troubleshooting

### Common Issues
- **Date Conversion Errors:**  
  Ensure your `.env` database settings are correct and that your database is empty or contains only valid data after migration and seeding.

- **File Upload Issues:**  
  Make sure you have run `php artisan storage:link` and the `public/data` directory is accessible.

- **Permission Issues:**  
  Ensure your web server user has write permissions to the `storage` and `bootstrap/cache` directories.

- **Migration Errors:**
  - Check that your database connection settings are correct
  - Ensure the database exists before running migrations
  - Use the testing environment to verify migrations work correctly

- **SQL Server Connection Issues:**
  - Verify SQL Server is running
  - Check that the SQL Server driver is installed
  - Ensure the database user has sufficient privileges

### Debug Commands
```bash
# Check current environment
php artisan env

# Clear application cache
php artisan cache:clear

# Clear configuration cache
php artisan config:clear

# Check database connection
php artisan tinker
# Then run: DB::connection()->getPdo();
```

---

## About & Contact
This project is a Laravel-based inventory management system, customized and maintained by Revanza. The system features a comprehensive approval workflow, audit trails, and multi-level authentication suitable for enterprise inventory management.

**Contact:**
- Email: revanza.raytama@gmail.com
- LinkedIn: [linkedin.com/in/revanzaraytama/](https://linkedin.com/in/revanzaraytama/)

For more information, see the [Laravel documentation](https://laravel.com/docs).

If you need further customization or run into issues, please contact Revanza.

---

## License
This project is proprietary software. All rights reserved.