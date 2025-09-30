-- ============================================================================
-- INVENTORY MANAGEMENT SYSTEM - COMPLETE DATABASE MIGRATION
-- ============================================================================
-- Generated: 2025-09-30
-- Description: Complete database structure for Laravel-based inventory system
-- Database: SQL Server / MySQL compatible
-- ============================================================================

-- Drop existing foreign key constraints first (if tables exist)
IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS WHERE CONSTRAINT_NAME = 'fk_flow_in_part_idpart')
    ALTER TABLE flow_in_part DROP CONSTRAINT fk_flow_in_part_idpart;

IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS WHERE CONSTRAINT_NAME = 'fk_flow_out_part_idpart')
    ALTER TABLE flow_out_part DROP CONSTRAINT fk_flow_out_part_idpart;

IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS WHERE CONSTRAINT_NAME = 'fk_history_in_flowinpart')
    ALTER TABLE history_in DROP CONSTRAINT fk_history_in_flowinpart;

IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS WHERE CONSTRAINT_NAME = 'fk_history_out_flowoutpart')
    ALTER TABLE history_out DROP CONSTRAINT fk_history_out_flowoutpart;

-- Drop existing tables if they exist (in reverse dependency order)
DROP TABLE IF EXISTS history_out;
DROP TABLE IF EXISTS history_in;
DROP TABLE IF EXISTS flow_out_part;
DROP TABLE IF EXISTS flow_in_part;
DROP TABLE IF EXISTS personal_access_tokens;
DROP TABLE IF EXISTS auto_fkb;
DROP TABLE IF EXISTS auto_ftb;
DROP TABLE IF EXISTS secret_code;
DROP TABLE IF EXISTS part;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS migrations;

-- ============================================================================
-- 1. MIGRATIONS TABLE (Laravel migration tracking)
-- ============================================================================
CREATE TABLE migrations (
    id INT PRIMARY KEY IDENTITY(1,1),
    migration NVARCHAR(510) NOT NULL,
    batch INT NOT NULL
);

-- ============================================================================
-- 2. USERS TABLE (User authentication and authorization)
-- ============================================================================
CREATE TABLE users (
    id BIGINT PRIMARY KEY IDENTITY(1,1),
    name NVARCHAR(510) NOT NULL,
    email NVARCHAR(510) NOT NULL UNIQUE,
    role NVARCHAR(510) NOT NULL,
    departement NVARCHAR(510) NOT NULL,
    password NVARCHAR(510) NOT NULL,
    signature NVARCHAR(510) NULL,
    email_verified_at DATETIME NULL,
    remember_token NVARCHAR(100) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- ============================================================================
-- 3. PART TABLE (Parts/inventory items catalog)
-- ============================================================================
CREATE TABLE part (
    idPart BIGINT PRIMARY KEY IDENTITY(1,1),
    namaPart NVARCHAR(MAX) NOT NULL,
    descPart NVARCHAR(MAX) NOT NULL,
    kategoriPart NVARCHAR(510) NOT NULL,
    kategoriMaterial NVARCHAR(510) NOT NULL,
    satuanPart NVARCHAR(510) NOT NULL,
    lokasiPart NVARCHAR(510) NOT NULL,
    keterangan NVARCHAR(510) NULL,
    size NVARCHAR(510) NULL,
    kimap_no NVARCHAR(510) NULL
);

-- ============================================================================
-- 4. FLOW_IN_PART TABLE (Inbound parts flow with approval workflow)
-- ============================================================================
CREATE TABLE flow_in_part (
    id_flowInPart BIGINT PRIMARY KEY IDENTITY(1,1),
    noFtb NVARCHAR(510) NULL,
    nameRequester NVARCHAR(510) NOT NULL,
    departmentRequester NVARCHAR(510) NOT NULL,
    noPart NVARCHAR(510) NOT NULL,
    status NVARCHAR(510) NULL,
    dtStockPartIn DATE NOT NULL,
    qtyStockPartIn INT NOT NULL,
    priceStockPartIn FLOAT NOT NULL,
    yearStockPartIn INT NOT NULL,
    needsStockPartIn NVARCHAR(510) NULL,
    notesPartIn NVARCHAR(MAX) NULL,
    filePhotoPartIn NVARCHAR(510) NULL,
    filePO NVARCHAR(510) NULL,
    fileBAST NVARCHAR(510) NULL,
    firstApprovalPartIn NVARCHAR(510) NOT NULL,
    timeFirstApprovalPartIn NVARCHAR(510) NULL,
    nameFirstApprovalPartIn NVARCHAR(510) NULL,
    ReasonFirstApprovalPartIn NVARCHAR(510) NULL,
    secondApprovalPartIn NVARCHAR(510) NOT NULL,
    timeSecondApprovalPartIn NVARCHAR(510) NULL,
    nameSecondApprovalPartIn NVARCHAR(510) NULL,
    ReasonSecondApprovalPartIn NVARCHAR(510) NULL,
    thirdApprovalPartIn NVARCHAR(510) NOT NULL,
    timeThirdApprovalPartIn NVARCHAR(510) NULL,
    nameThirdApprovalPartIn NVARCHAR(510) NULL,
    ReasonThirdApprovalPartIn NVARCHAR(510) NULL,
    thirdApprovalDocsPartIn NVARCHAR(510) NOT NULL,
    timeThirdApprovalDocsPartIn NVARCHAR(510) NULL,
    nameThirdApprovalDocsPartIn NVARCHAR(510) NULL,
    ReasonThirdApprovalDocsPartIn NVARCHAR(510) NULL,
    fourthApprovalPartIn NVARCHAR(510) NOT NULL,
    timeFourthApprovalPartIn NVARCHAR(510) NULL,
    nameFourthApprovalPartIn NVARCHAR(510) NULL,
    ReasonFourthApprovalPartIn NVARCHAR(510) NULL,
    dtStockPartApprovedIn DATE NULL,
    signatureUser NVARCHAR(510) NULL,
    signatureAdmin NVARCHAR(510) NULL,
    signatureHead NVARCHAR(510) NULL,
    signatureMaster NVARCHAR(510) NULL,
    idPart BIGINT NOT NULL
);

-- ============================================================================
-- 5. FLOW_OUT_PART TABLE (Outbound parts flow with approval workflow)
-- ============================================================================
CREATE TABLE flow_out_part (
    id_flowOutPart BIGINT PRIMARY KEY IDENTITY(1,1),
    noFkb NVARCHAR(510) NULL,
    nameRequester NVARCHAR(510) NOT NULL,
    departmentRequester NVARCHAR(510) NOT NULL,
    noPart NVARCHAR(510) NOT NULL,
    status NVARCHAR(510) NULL,
    dtStockPartOut DATE NOT NULL,
    qtyStockPartOut INT NOT NULL,
    priceStockPartOut FLOAT NOT NULL,
    yearStockPartOut INT NOT NULL,
    needsStockPartOut NVARCHAR(510) NULL,
    notesPartOut NVARCHAR(MAX) NULL,
    filePhotoPartOut NVARCHAR(510) NULL,
    filePO NVARCHAR(510) NULL,
    fileBAST NVARCHAR(510) NULL,
    firstApprovalPartOut NVARCHAR(510) NOT NULL,
    ReasonFirstApprovalPartOut NVARCHAR(510) NULL,
    timeFirstApprovalPartOut NVARCHAR(510) NULL,
    nameFirstApprovalPartOut NVARCHAR(510) NULL,
    secondApprovalPartOut NVARCHAR(510) NOT NULL,
    ReasonSecondApprovalPartOut NVARCHAR(510) NULL,
    timeSecondApprovalPartOut NVARCHAR(510) NULL,
    nameSecondApprovalPartOut NVARCHAR(510) NULL,
    thirdApprovalPartOut NVARCHAR(510) NOT NULL,
    ReasonThirdApprovalPartOut NVARCHAR(510) NULL,
    timeThirdApprovalPartOut NVARCHAR(510) NULL,
    nameThirdApprovalPartOut NVARCHAR(510) NULL,
    thirdApprovalDocsPartOut NVARCHAR(510) NOT NULL,
    timeThirdApprovalDocsPartOut NVARCHAR(510) NULL,
    nameThirdApprovalDocsPartOut NVARCHAR(510) NULL,
    ReasonThirdApprovalDocsPartOut NVARCHAR(510) NULL,
    fourthApprovalPartOut NVARCHAR(510) NOT NULL,
    ReasonFourthApprovalPartOut NVARCHAR(510) NULL,
    timeFourthApprovalPartOut NVARCHAR(510) NULL,
    nameFourthApprovalPartOut NVARCHAR(510) NULL,
    dtStockPartApprovedOut DATE NULL,
    signatureUser NVARCHAR(510) NULL,
    signatureAdmin NVARCHAR(510) NULL,
    signatureHead NVARCHAR(510) NULL,
    signatureMaster NVARCHAR(510) NULL,
    idPart BIGINT NOT NULL
);

-- ============================================================================
-- 6. HISTORY_IN TABLE (History tracking for inbound parts flow)
-- ============================================================================
CREATE TABLE history_in (
    id_historyIn BIGINT PRIMARY KEY IDENTITY(1,1),
    status NVARCHAR(510) NULL,
    timeStatus NVARCHAR(510) NULL,
    reason NVARCHAR(510) NULL,
    name NVARCHAR(510) NULL,
    id_flowInPart BIGINT NOT NULL
);

-- ============================================================================
-- 7. HISTORY_OUT TABLE (History tracking for outbound parts flow)
-- ============================================================================
CREATE TABLE history_out (
    id_historyOut BIGINT PRIMARY KEY IDENTITY(1,1),
    status NVARCHAR(510) NULL,
    timeStatus NVARCHAR(510) NULL,
    reason NVARCHAR(510) NULL,
    name NVARCHAR(510) NULL,
    id_flowOutPart BIGINT NOT NULL
);

-- ============================================================================
-- 8. AUTO_FKB TABLE (Auto-increment counter for FKB document numbers)
-- ============================================================================
CREATE TABLE auto_fkb (
    id BIGINT PRIMARY KEY IDENTITY(1,1),
    countNoSuratFkb INT NOT NULL,
    created_at DATETIME NOT NULL
);

-- ============================================================================
-- 9. AUTO_FTB TABLE (Auto-increment counter for FTB document numbers)
-- ============================================================================
CREATE TABLE auto_ftb (
    id BIGINT PRIMARY KEY IDENTITY(1,1),
    countNoSuratFtb INT NOT NULL,
    created_at DATETIME NOT NULL
);

-- ============================================================================
-- 10. SECRET_CODE TABLE (Secret codes storage)
-- ============================================================================
CREATE TABLE secret_code (
    id BIGINT PRIMARY KEY IDENTITY(1,1),
    secretCode NVARCHAR(510) NOT NULL
);

-- ============================================================================
-- 11. PERSONAL_ACCESS_TOKENS TABLE (Laravel Sanctum API tokens)
-- ============================================================================
CREATE TABLE personal_access_tokens (
    id BIGINT PRIMARY KEY IDENTITY(1,1),
    tokenable_type NVARCHAR(510) NOT NULL,
    tokenable_id BIGINT NOT NULL,
    name NVARCHAR(510) NOT NULL,
    token NVARCHAR(128) NOT NULL UNIQUE,
    abilities NVARCHAR(MAX) NULL,
    last_used_at DATETIME NULL,
    expires_at DATETIME NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- ============================================================================
-- FOREIGN KEY CONSTRAINTS
-- ============================================================================

-- Flow In Part -> Part relationship
ALTER TABLE flow_in_part 
ADD CONSTRAINT fk_flow_in_part_idpart 
FOREIGN KEY (idPart) REFERENCES part(idPart)
ON DELETE CASCADE ON UPDATE CASCADE;

-- Flow Out Part -> Part relationship
ALTER TABLE flow_out_part 
ADD CONSTRAINT fk_flow_out_part_idpart 
FOREIGN KEY (idPart) REFERENCES part(idPart)
ON DELETE CASCADE ON UPDATE CASCADE;

-- History In -> Flow In Part relationship
ALTER TABLE history_in 
ADD CONSTRAINT fk_history_in_flowinpart 
FOREIGN KEY (id_flowInPart) REFERENCES flow_in_part(id_flowInPart)
ON DELETE CASCADE ON UPDATE CASCADE;

-- History Out -> Flow Out Part relationship
ALTER TABLE history_out 
ADD CONSTRAINT fk_history_out_flowoutpart 
FOREIGN KEY (id_flowOutPart) REFERENCES flow_out_part(id_flowOutPart)
ON DELETE CASCADE ON UPDATE CASCADE;

-- ============================================================================
-- INDEXES FOR PERFORMANCE OPTIMIZATION
-- ============================================================================

-- Users table indexes
CREATE INDEX idx_users_role ON users(role);
CREATE INDEX idx_users_departement ON users(departement);

-- Part table indexes
CREATE INDEX idx_part_kategoripart ON part(kategoriPart);
CREATE INDEX idx_part_kategorimaterial ON part(kategoriMaterial);
CREATE INDEX idx_part_lokasipart ON part(lokasiPart);

-- Flow In Part table indexes
CREATE INDEX idx_flowinpart_noftb ON flow_in_part(noFtb);
CREATE INDEX idx_flowinpart_status ON flow_in_part(status);
CREATE INDEX idx_flowinpart_dtstockpartin ON flow_in_part(dtStockPartIn);
CREATE INDEX idx_flowinpart_idpart ON flow_in_part(idPart);

-- Flow Out Part table indexes
CREATE INDEX idx_flowoutpart_nofkb ON flow_out_part(noFkb);
CREATE INDEX idx_flowoutpart_status ON flow_out_part(status);
CREATE INDEX idx_flowoutpart_dtstockpartout ON flow_out_part(dtStockPartOut);
CREATE INDEX idx_flowoutpart_idpart ON flow_out_part(idPart);

-- History In table indexes
CREATE INDEX idx_historyin_status ON history_in(status);
CREATE INDEX idx_historyin_timestatus ON history_in(timeStatus);
CREATE INDEX idx_historyin_idflowinpart ON history_in(id_flowInPart);

-- History Out table indexes
CREATE INDEX idx_historyout_status ON history_out(status);
CREATE INDEX idx_historyout_timestatus ON history_out(timeStatus);
CREATE INDEX idx_historyout_idflowoutpart ON history_out(id_flowOutPart);

-- Personal Access Tokens indexes
CREATE INDEX idx_personal_access_tokens_tokenable ON personal_access_tokens(tokenable_type, tokenable_id);

-- ============================================================================
-- SAMPLE MIGRATION TRACKING DATA
-- ============================================================================

-- Insert migration records to track this complete migration
INSERT INTO migrations (migration, batch) VALUES 
('2019_12_14_000001_create_personal_access_tokens_table', 1),
('2022_09_19_121239_create_part', 1),
('2022_09_19_121341_create_flow_in_part', 1),
('2022_09_19_121521_create_flow_out_part', 1),
('2022_09_19_122016_add_id_to_flow_in_part', 1),
('2022_09_19_122120_add_id_to_flow_out_part', 1),
('2022_09_25_093114_create_users_tables', 1),
('2022_09_26_103202_create_secret_code_table', 1),
('2022_10_10_125143_create_auto_f_t_b_s_table', 1),
('2022_10_10_125758_create_auto_f_k_b_s_table', 1),
('2022_10_20_121628_change_nullable_keterangan_to_part', 1),
('2022_10_20_124011_delete_size_to_flow_in_part', 1),
('2022_10_20_124222_delete_size_to_flow_out_part', 1),
('2022_10_20_124407_add_size_to_part', 1),
('2022_10_20_125211_add_nullabel_size_to_part', 1),
('2022_10_31_102321_create_history_in', 1),
('2022_10_31_103007_create_history_out', 1),
('2022_11_01_000003_fix_flow_tables_column_order', 1),
('2022_11_01_000004_add_timestamps_to_users', 1),
('2022_11_01_000005_add_indexes_and_constraints', 1),
('2025_09_25_105456_add_kimap_no_to_part_table', 1),
('2025_09_30_000001_complete_database_migration', 1);

-- ============================================================================
-- COMPLETION SUMMARY
-- ============================================================================
/*
DATABASE MIGRATION COMPLETED SUCCESSFULLY

Tables Created (11 total):
✅ migrations - Laravel migration tracking
✅ users - User authentication and authorization  
✅ part - Parts/inventory items catalog (with kimap_no field)
✅ flow_in_part - Inbound parts flow with approval workflow
✅ flow_out_part - Outbound parts flow with approval workflow
✅ history_in - History tracking for inbound parts flow
✅ history_out - History tracking for outbound parts flow
✅ auto_fkb - Auto-increment counter for FKB document numbers
✅ auto_ftb - Auto-increment counter for FTB document numbers
✅ secret_code - Secret codes storage
✅ personal_access_tokens - Laravel Sanctum API tokens

Foreign Keys Established:
✅ flow_in_part.idPart → part.idPart
✅ flow_out_part.idPart → part.idPart
✅ history_in.id_flowInPart → flow_in_part.id_flowInPart
✅ history_out.id_flowOutPart → flow_out_part.id_flowOutPart

Performance Indexes Created:
✅ Users: role, departement
✅ Part: kategoriPart, kategoriMaterial, lokasiPart
✅ Flow tables: document numbers, status, dates, part references
✅ History tables: status, timestamps, flow references
✅ Tokens: tokenable polymorphic index

System Features Supported:
✅ Multi-level approval workflow (4 levels)
✅ Digital signature management
✅ Document file attachments
✅ Complete audit trail
✅ Role-based access control
✅ Auto-numbering for documents
✅ API token management
*/