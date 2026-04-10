CREATE DATABASE IF NOT EXISTS fit_feetug;
USE fit_feetug;

-- Drop tables in reverse order of dependencies
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS users;

-- Categories table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    slug VARCHAR(50) NOT NULL UNIQUE
);

-- Products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category_id INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100),
    customer_phone VARCHAR(20) NOT NULL,
    customer_address TEXT NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    order_status VARCHAR(50) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Order items table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert categories
INSERT INTO categories (name, slug) VALUES
('Men', 'men'),
('Women', 'women'),
('Children', 'children');

-- Insert sample products
INSERT INTO products (name, category_id, price, description, image) VALUES
-- Men's Collection (15 products)
('Urban Runners', 1, 125000, 'Lightweight mesh running shoes perfect for city jogging and daily workouts', 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=80'),
('Classic Loafers', 1, 159000, 'Genuine leather loafers with sleek design for formal and casual occasions', 'assets/men1.jpg'),
('Trail Blazer', 1, 210000, 'Durable grip for outdoor adventures and rugged terrains', 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=600&q=80'),
('Classic Oxford', 1, 185000, 'Fashionable oxford shoes with premium leather and timeless styling', 'https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?w=600&q=80'),
('Canvas Slip-On', 1, 145000, 'Relaxed canvas slip-ons for weekend outings and everyday comfort', 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?w=600&q=80'),
('Desert Boot', 1, 135000, 'Versatile desert boots with suede finish for all-season wear', 'https://images.unsplash.com/photo-1608256246200-53e635b5b65f?w=600&q=80'),
('Sport Max', 1, 225000, 'High-performance athletic shoes with responsive cushioning', 'https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?w=600&q=80'),
('Urban Runner', 1, 95000, 'Lightweight urban runners with breathable mesh upper', 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=600&q=80'),
('Flex Walker', 1, 175000, 'Flexible walking shoes for long-distance comfort and support', 'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=600&q=80'),
('Power Stride', 1, 155000, 'Breathable trainers designed for gym sessions and weekend runs', 'https://images.unsplash.com/photo-1539185441755-769473a23570?w=600&q=80'),
('Executive Loafer', 1, 119000, 'Polished slip-on loafers perfect for boardroom and brunch', 'https://images.unsplash.com/photo-1626379953822-baec19c3accd?w=600&q=80'),
('Kampala Jogger', 1, 139000, 'Street-style jogger with memory foam insole and bold stitching', 'https://images.unsplash.com/photo-1552346154-21d32810aba3?w=600&q=80'),
('Safari Hiker', 1, 248000, 'Waterproof hiking boots built for Ugandan trails and rainy seasons', 'https://images.unsplash.com/photo-1520219306100-ec4afeeefe58?w=600&q=80'),
('Nile Breeze', 1, 112000, 'Open-weave breathable sneakers for hot Kampala days', 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=600&q=80'),
('Summit Pro', 1, 199000, 'Premium cross-training shoes with ankle lock technology', 'https://images.unsplash.com/photo-1556048219-bb6978360b84?w=600&q=80'),

-- Women's Collection (22 products)
('Elegant Heels', 2, 189000, 'Party-ready stilettos with padded insole for all-night comfort', 'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?w=600&q=80'),
('Casual Flats', 2, 85000, 'Comfort all day long with memory foam and soft leather upper', 'https://images.unsplash.com/photo-1566150905458-1bf1fc113f0d?w=600&q=80'),
('Sneaker Chic', 2, 135000, 'Trendy everyday sneakers with rose-gold accents', 'https://images.unsplash.com/photo-1595341888016-a392ef81b7de?w=600&q=80'),
('Chic Pumps', 2, 172000, 'Sleek pumps with cushioned insole for evening wear', 'https://images.unsplash.com/photo-1515347619252-60a4bf4fff4f?w=600&q=80'),
('Lace-Up Sandals', 2, 98000, 'Lightweight lace-up sandals for summer outings', 'https://images.unsplash.com/photo-1603487742131-4160ec999306?w=600&q=80'),
('Velvet Slingback', 2, 195000, 'Luxurious velvet slingback heels with adjustable strap for formal events', 'https://images.unsplash.com/photo-1596703263926-eb0762ee17e4?w=600&q=80'),
('Teal Kitten Heel', 2, 155000, 'Low kitten heels in teal with soft suede finish for office and dinner', 'https://images.unsplash.com/photo-1551107696-a4b0c5a0d9a2?w=600&q=80'),
('Sunset Espadrille', 2, 108000, 'Woven espadrille wedges with warm sunset-toned canvas upper', 'https://images.unsplash.com/photo-1535043934128-cf0b28d52f95?w=600&q=80'),
('Lilac Platform', 2, 178000, 'Bold platform sneakers in lilac with chunky sole and foam cushioning', 'https://images.unsplash.com/photo-1581101767113-1677fc2beaa8?w=600&q=80'),
('Cherry Loafer', 2, 129000, 'Glossy cherry-red loafers with tassel detail for smart-casual wear', 'https://images.unsplash.com/photo-1604001307862-2d953b875079?w=600&q=80'),
('Ocean Breeze Slide', 2, 72000, 'Lightweight slide sandals with contoured footbed for beach and pool', 'https://images.unsplash.com/photo-1562273138-f46be4ebdf33?w=600&q=80'),
('Emerald Stiletto', 2, 225000, 'Stunning emerald green stilettos with pointed toe for gala nights', 'https://images.unsplash.com/photo-1518049362265-d5b2a6467637?w=600&q=80'),
('Gold Strap Sandal', 2, 145000, 'Metallic gold strappy sandals with block heel for weddings and parties', 'https://images.unsplash.com/photo-1590099033615-be195f8d575c?w=600&q=80'),
('Indigo Peep Toe', 2, 168000, 'Deep indigo peep-toe pumps with leather lining and arch support', 'https://images.unsplash.com/photo-1605812860427-4024433a70fd?w=600&q=80'),
('Orchid Sneaker', 2, 132000, 'Floral-print lifestyle sneakers with breathable knit upper', 'https://images.unsplash.com/photo-1584735175315-9d5df23860e6?w=600&q=80'),
('Silver Moon Boot', 2, 198000, 'Metallic silver ankle boots with side zipper for cold evenings', 'assets/women10.svg'),
('Blush Bow Flat', 2, 88000, 'Sweet blush pink flats with oversized bow accent for everyday elegance', 'https://images.unsplash.com/photo-1554062614-6da4fa67725a?w=600&q=80'),
('Pearl Ballet', 2, 79000, 'Delicate ballet flats with pearl embellishments for elegant casual looks', 'https://images.unsplash.com/photo-1519415943484-9fa1882496d4?w=600&q=80'),
('Rooftop Wedge', 2, 165000, 'Espadrille wedge sandals perfect for weekend brunches and outdoor events', 'https://images.unsplash.com/photo-1608667508764-33cf0726b13a?w=600&q=80'),
('City Stride Trainers', 2, 142000, 'Sporty trainers with arch support and pastel colourways', 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=600&q=80'),
('Savanna Mule', 2, 118000, 'Open-back mules with woven detail inspired by Ugandan craft', 'https://images.unsplash.com/photo-1598033129183-c4f50c736c10?w=600&q=80'),
('Ankole Ankle Boot', 2, 215000, 'Sleek ankle boots crafted from premium faux leather with side zip', 'https://images.unsplash.com/photo-1605733160314-4fc7dac4bb16?w=600&q=80'),
('Nairobi Strappy Heel', 2, 185000, 'Strappy block heels with ankle wrap detail for date nights and dinners', 'https://images.unsplash.com/photo-1585488763177-bab8db8d510b?w=600&q=80'),
('Cozy Cloud Sneaker', 2, 125000, 'Ultra-soft knit sneakers with cloud foam sole for all-day walking', 'https://images.unsplash.com/photo-1621665421558-831f91fd8f1b?w=600&q=80'),

-- Children's Collection (22 products)
('Kid Sport', 3, 65000, 'Non-slip sole for active kids with colourful design', 'https://images.unsplash.com/photo-1514989940723-e8e51635b782?w=600&q=80'),
('Little Boots', 3, 78000, 'Warm and cozy rain boots for puddle adventures', 'https://images.unsplash.com/photo-1604671801908-6f0c6a092c05?w=600&q=80'),
('School Shoes', 3, 89000, 'Durable and neat for school with reinforced toe', 'https://images.unsplash.com/photo-1551107696-a4b0c5a0d9a2?w=600&q=80'),
('Adventure Sneakers', 3, 72000, 'Durable kids sneakers with extra ankle support', 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=600&q=80'),
('Playtime Slip-Ons', 3, 59000, 'Easy-wear slip-ons for quick play and school days', 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?w=600&q=80'),
('Bright Runners', 3, 68000, 'Lightweight runners built for fast play and comfort', 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=80'),
('Mini Stride Trainers', 3, 62000, 'Everyday trainers with cushioning for growing feet', 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=600&q=80'),
('Sunny Day Sandal', 3, 48000, 'Open-toe sandals with cushioned sole for sunny playground days', 'https://images.unsplash.com/photo-1603487742131-4160ec999306?w=600&q=80'),
('Galaxy High-Top', 3, 76000, 'Space-themed high-top sneakers with glow-in-the-dark stars', 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=600&q=80'),
('Princess Glitter', 3, 69000, 'Sparkly pink shoes with glitter finish and velcro closure', 'https://images.unsplash.com/photo-1581101767113-1677fc2beaa8?w=600&q=80'),
('Jungle Explorer', 3, 85000, 'Rugged outdoor shoes with camo pattern and reinforced toe cap', 'https://images.unsplash.com/photo-1520219306100-ec4afeeefe58?w=600&q=80'),
('Splash Guard', 3, 92000, 'Waterproof rain boots with fun prints for puddle jumping', 'https://images.unsplash.com/photo-1604671801908-6f0c6a092c05?w=600&q=80'),
('Tiger Cub Trainer', 3, 64000, 'Orange-striped trainers with elastic laces for easy on-off', 'https://images.unsplash.com/photo-1539185441755-769473a23570?w=600&q=80'),
('Unicorn Magic', 3, 71000, 'Pastel unicorn-themed sneakers with rainbow sole for magical days', 'https://images.unsplash.com/photo-1584735175315-9d5df23860e6?w=600&q=80'),
('Speedy Racer', 3, 58000, 'Aerodynamic racing shoes with lightning bolt design for fast kids', 'https://images.unsplash.com/photo-1552346154-21d32810aba3?w=600&q=80'),
('Dino Stomper', 3, 75000, 'Dinosaur-print shoes with chunky sole and roar-worthy style', 'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=600&q=80'),
('Rocket Blaster', 3, 67000, 'Space rocket sneakers with light-up heel for intergalactic play', 'https://images.unsplash.com/photo-1556048219-bb6978360b84?w=600&q=80'),
('Campus Classic', 3, 88000, 'Smart leather school shoes with anti-scuff coating and padded collar', 'https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?w=600&q=80'),
('Bumblebee Bounce', 3, 52000, 'Yellow-and-black striped shoes with bouncy foam sole for energetic kids', 'https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?w=600&q=80'),
('Tiny Trekkers', 3, 74000, 'Outdoor hiking sandals with adjustable velcro straps for toddlers', 'https://images.unsplash.com/photo-1608256246200-53e635b5b65f?w=600&q=80'),
('Rainbow Kicks', 3, 55000, 'Vibrant rainbow-laced sneakers that light up with every step', 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=600&q=80'),
('Junior Champ', 3, 82000, 'Football-inspired boots for budding young athletes on the pitch', 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=600&q=80');

-- Insert users (password: admin123 and customer123)
INSERT INTO users (full_name, email, password, role) VALUES 
('System Admin', 'admin@fitfeetug.com', '$2y$10$W7puObez5XCngT6CjQhF9.MIBS3Q8bGR2cSjnn24Zi/0rcpuJdD2u', 'admin'),
('John Doe', 'customer@example.com', '$2y$10$3aFS3pbnZOEkkLd9MGCnVu0hI3PDsUkbxmm6DRmvxkt0dZvcEzLoq', 'customer');