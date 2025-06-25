# Database Schema Documentation

## Overview
This Laravel-based inventory management system manages parts flow (in/out), user authentication, and approval workflows.

## Tables Structure

### 1. `users`
- **Purpose**: User authentication and authorization
- **Columns**:
  - `id` (bigint, PK, auto-increment)
  - `name` (nvarchar 510)
  - `email` (nvarchar 510, unique)
  - `role` (nvarchar 510)
  - `departement` (nvarchar 510)
  - `password` (nvarchar 510)
  - `signature` (nvarchar 510, nullable)
  - `email_verified_at` (datetime, nullable)
  - `remember_token` (varchar 100, nullable)
  - `created_at` (datetime, nullable)
  - `updated_at` (datetime, nullable)

### 2. `part`
- **Purpose**: Parts/inventory items catalog
- **Columns**:
  - `idPart` (bigint, PK, auto-increment)
  - `namaPart` (nvarchar max)
  - `descPart` (nvarchar max)
  - `kategoriPart` (nvarchar 510)
  - `kategoriMaterial` (nvarchar 510)
  - `satuanPart` (nvarchar 510)
  - `lokasiPart` (nvarchar 510)
  - `keterangan` (nvarchar 510, nullable)
  - `size` (nvarchar 510, nullable)

### 3. `flow_in_part`
- **Purpose**: Inbound parts flow management with approval workflow
- **Columns**:
  - `id_flowInPart` (bigint, PK, auto-increment)
  - `noFtb` (nvarchar 510, nullable)
  - `nameRequester` (nvarchar 510)
  - `departmentRequester` (nvarchar 510)
  - `noPart` (nvarchar 510)
  - `status` (nvarchar 510, nullable)
  - `dtStockPartIn` (date)
  - `qtyStockPartIn` (int)
  - `priceStockPartIn` (float)
  - `yearStockPartIn` (int)
  - `needsStockPartIn` (nvarchar 510, nullable)
  - `notesPartIn` (nvarchar max, nullable)
  - `filePhotoPartIn` (nvarchar 510, nullable)
  - `filePO` (nvarchar 510, nullable)
  - `fileBAST` (nvarchar 510, nullable)
  - `firstApprovalPartIn` (nvarchar 510)
  - `timeFirstApprovalPartIn` (nvarchar 510, nullable)
  - `nameFirstApprovalPartIn` (nvarchar 510, nullable)
  - `ReasonFirstApprovalPartIn` (nvarchar 510, nullable)
  - `secondApprovalPartIn` (nvarchar 510)
  - `timeSecondApprovalPartIn` (nvarchar 510, nullable)
  - `nameSecondApprovalPartIn` (nvarchar 510, nullable)
  - `ReasonSecondApprovalPartIn` (nvarchar 510, nullable)
  - `thirdApprovalPartIn` (nvarchar 510)
  - `timeThirdApprovalPartIn` (nvarchar 510, nullable)
  - `nameThirdApprovalPartIn` (nvarchar 510, nullable)
  - `ReasonThirdApprovalPartIn` (nvarchar 510, nullable)
  - `thirdApprovalDocsPartIn` (nvarchar 510)
  - `timeThirdApprovalDocsPartIn` (nvarchar 510, nullable)
  - `nameThirdApprovalDocsPartIn` (nvarchar 510, nullable)
  - `ReasonThirdApprovalDocsPartIn` (nvarchar 510, nullable)
  - `fourthApprovalPartIn` (nvarchar 510)
  - `timeFourthApprovalPartIn` (nvarchar 510, nullable)
  - `nameFourthApprovalPartIn` (nvarchar 510, nullable)
  - `ReasonFourthApprovalPartIn` (nvarchar 510, nullable)
  - `dtStockPartApprovedIn` (date, nullable)
  - `signatureUser` (nvarchar 510, nullable)
  - `signatureAdmin` (nvarchar 510, nullable)
  - `signatureHead` (nvarchar 510, nullable)
  - `signatureMaster` (nvarchar 510, nullable)
  - `idPart` (bigint, FK to part.idPart)

### 4. `flow_out_part`
- **Purpose**: Outbound parts flow management with approval workflow
- **Columns**:
  - `id_flowOutPart` (bigint, PK, auto-increment)
  - `noFkb` (nvarchar 510, nullable)
  - `nameRequester` (nvarchar 510)
  - `departmentRequester` (nvarchar 510)
  - `noPart` (nvarchar 510)
  - `status` (nvarchar 510, nullable)
  - `dtStockPartOut` (date)
  - `qtyStockPartOut` (int)
  - `priceStockPartOut` (float)
  - `yearStockPartOut` (int)
  - `needsStockPartOut` (nvarchar 510, nullable)
  - `notesPartOut` (nvarchar max, nullable)
  - `filePhotoPartOut` (nvarchar 510, nullable)
  - `filePO` (nvarchar 510, nullable)
  - `fileBAST` (nvarchar 510, nullable)
  - `firstApprovalPartOut` (nvarchar 510)
  - `ReasonFirstApprovalPartOut` (nvarchar 510, nullable)
  - `timeFirstApprovalPartOut` (nvarchar 510, nullable)
  - `nameFirstApprovalPartOut` (nvarchar 510, nullable)
  - `secondApprovalPartOut` (nvarchar 510)
  - `ReasonSecondApprovalPartOut` (nvarchar 510, nullable)
  - `timeSecondApprovalPartOut` (nvarchar 510, nullable)
  - `nameSecondApprovalPartOut` (nvarchar 510, nullable)
  - `thirdApprovalPartOut` (nvarchar 510)
  - `ReasonThirdApprovalPartOut` (nvarchar 510, nullable)
  - `timeThirdApprovalPartOut` (nvarchar 510, nullable)
  - `nameThirdApprovalPartOut` (nvarchar 510, nullable)
  - `thirdApprovalDocsPartOut` (nvarchar 510)
  - `timeThirdApprovalDocsPartOut` (nvarchar 510, nullable)
  - `nameThirdApprovalDocsPartOut` (nvarchar 510, nullable)
  - `ReasonThirdApprovalDocsPartOut` (nvarchar 510, nullable)
  - `fourthApprovalPartOut` (nvarchar 510)
  - `ReasonFourthApprovalPartOut` (nvarchar 510, nullable)
  - `timeFourthApprovalPartOut` (nvarchar 510, nullable)
  - `nameFourthApprovalPartOut` (nvarchar 510, nullable)
  - `dtStockPartApprovedOut` (date, nullable)
  - `signatureUser` (nvarchar 510, nullable)
  - `signatureAdmin` (nvarchar 510, nullable)
  - `signatureHead` (nvarchar 510, nullable)
  - `signatureMaster` (nvarchar 510, nullable)
  - `idPart` (bigint, FK to part.idPart)

### 5. `history_in`
- **Purpose**: History tracking for inbound parts flow
- **Columns**:
  - `id_historyIn` (bigint, PK, auto-increment)
  - `status` (nvarchar 510, nullable)
  - `timeStatus` (nvarchar 510, nullable)
  - `reason` (nvarchar 510, nullable)
  - `name` (nvarchar 510, nullable)
  - `id_flowInPart` (bigint, FK to flow_in_part.id_flowInPart)

### 6. `history_out`
- **Purpose**: History tracking for outbound parts flow
- **Columns**:
  - `id_historyOut` (bigint, PK, auto-increment)
  - `status` (nvarchar 510, nullable)
  - `timeStatus` (nvarchar 510, nullable)
  - `reason` (nvarchar 510, nullable)
  - `name` (nvarchar 510, nullable)
  - `id_flowOutPart` (bigint, FK to flow_out_part.id_flowOutPart)

### 7. `auto_fkb`
- **Purpose**: Auto-increment counter for FKB document numbers
- **Columns**:
  - `id` (bigint, PK, auto-increment)
  - `countNoSuratFkb` (int)
  - `created_at` (datetime)

### 8. `auto_ftb`
- **Purpose**: Auto-increment counter for FTB document numbers
- **Columns**:
  - `id` (bigint, PK, auto-increment)
  - `countNoSuratFtb` (int)
  - `created_at` (datetime)

### 9. `secret_code`
- **Purpose**: Secret codes storage
- **Columns**:
  - `id` (bigint, PK, auto-increment)
  - `secretCode` (nvarchar 510)

### 10. `personal_access_tokens`
- **Purpose**: Laravel Sanctum API tokens
- **Columns**:
  - `id` (bigint, PK, auto-increment)
  - `tokenable_type` (nvarchar 510)
  - `tokenable_id` (bigint)
  - `name` (nvarchar 510)
  - `token` (nvarchar 128, unique)
  - `abilities` (nvarchar max, nullable)
  - `last_used_at` (datetime, nullable)
  - `expires_at` (datetime, nullable)
  - `created_at` (datetime, nullable)
  - `updated_at` (datetime, nullable)

### 11. `migrations`
- **Purpose**: Laravel migration tracking
- **Columns**:
  - `id` (int, PK, auto-increment)
  - `migration` (nvarchar 510)
  - `batch` (int)

## Relationships

### Foreign Keys
- `flow_in_part.idPart` → `part.idPart`
- `flow_out_part.idPart` → `part.idPart`
- `history_in.id_flowInPart` → `flow_in_part.id_flowInPart`
- `history_out.id_flowOutPart` → `flow_out_part.id_flowOutPart`
- `personal_access_tokens.tokenable_id` → `users.id` (polymorphic)

## Indexes (for performance)
- `users.email` (unique)
- `users.role`, `users.departement`
- `part.kategoriPart`, `part.kategoriMaterial`, `part.lokasiPart`
- `flow_in_part.noFtb`, `flow_in_part.status`, `flow_in_part.dtStockPartIn`
- `flow_out_part.noFkb`, `flow_out_part.status`, `flow_out_part.dtStockPartOut`
- `history_in.status`, `history_in.timeStatus`
- `history_out.status`, `history_out.timeStatus`

## Migration Files Created/Updated ✅

1. `2019_12_14_000001_create_personal_access_tokens_table.php` - Laravel Sanctum tokens
2. `2022_11_01_000003_fix_flow_tables_column_order.php` - Fix column structure
3. `2022_11_01_000004_add_timestamps_to_users.php` - Add Laravel standard fields to users
4. `2022_11_01_000005_add_indexes_and_constraints.php` - Add performance indexes

## Testing Results ✅

**Database**: `inventory_test`  
**Environment**: `.env.testing`  
**Migration Status**: All migrations successfully applied  

### Tables Created (11 total):
- ✅ auto_fkb
- ✅ auto_ftb  
- ✅ flow_in_part (with idPart foreign key)
- ✅ flow_out_part (with idPart foreign key)
- ✅ history_in (with id_flowInPart foreign key)
- ✅ history_out (with id_flowOutPart foreign key)
- ✅ migrations
- ✅ part
- ✅ personal_access_tokens
- ✅ secret_code
- ✅ users

### Foreign Keys Verified:
- ✅ `flow_in_part.idPart` → `part.idPart`
- ✅ `flow_out_part.idPart` → `part.idPart`  
- ✅ `history_in.id_flowInPart` → `flow_in_part.id_flowInPart`
- ✅ `history_out.id_flowOutPart` → `flow_out_part.id_flowOutPart`

### Commands for Testing:
```bash
# Create test database
sqlcmd -S .\SQLEXPRESS -U sa -P admin123 -Q "CREATE DATABASE inventory_test"

# Run migrations on test database
php artisan migrate --env=testing

# Check migration status
php artisan migrate:status --env=testing

# Test rollback functionality
php artisan migrate:rollback --env=testing --step=1
php artisan migrate --env=testing
```

## Workflow Description

This system manages an inventory approval workflow:

1. **Parts Management**: Basic parts catalog with categories, materials, and locations
2. **Inbound Flow**: FTB (Form Transfer Barang) documents for parts coming in
3. **Outbound Flow**: FKB (Form Keluar Barang) documents for parts going out
4. **Multi-level Approval**: 4 levels of approval for each flow
5. **History Tracking**: Complete audit trail for status changes
6. **User Management**: Role-based access with departments and digital signatures
7. **Document Management**: File attachments for photos, PO, and BAST documents

The system supports digital signatures at multiple levels and maintains comprehensive history for compliance and auditing purposes. 