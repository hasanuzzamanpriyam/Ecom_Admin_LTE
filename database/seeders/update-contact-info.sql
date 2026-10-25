-- Update phone
UPDATE settings SET value = '+8809648156713' WHERE name = 'SITE_INFO_PHONE';

-- Update emails
UPDATE settings SET value = 'support@tic.com.bd' WHERE name = 'SITE_INFO_SUPPORT_MAIL';
UPDATE settings SET value = 'support@tic.com.bd' WHERE name = 'email';

-- Update address
UPDATE settings
SET value = 'A.H. Tower (5th Floor), H# G-71, Alokar Mor, Ghoramara Rajshahi, 6100'
WHERE name = 'SITE_INFO_ADDRESS';

-- Update social links to placeholder
UPDATE settings SET value = '#' WHERE name IN ('facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'whatsapp', 'messanger');

-- Update footer & copyright
UPDATE settings SET value = 'TIC is a trusted e-commerce platform in Bangladesh.' WHERE name = 'footer_description';
UPDATE settings SET value = '© All Rights Reserved By TIC' WHERE name = 'copy_right_text';
