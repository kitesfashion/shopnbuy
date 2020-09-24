-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2020 at 01:54 PM
-- Server version: 10.3.22-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopnbuycom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `roleName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roleLevel` int(11) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `delivery_zone_id`, `role`, `roleName`, `roleLevel`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jisan Ahmed', 'jisanahmed06@gmail.com', 'jisan', NULL, 2, 'Super User', 1, '$2y$10$/et5nrWP1LuUjzw.oFWaI.jtQDJG.JPzFlFPIl5ZGe7ESaSDTAzoC', 1, NULL, '2019-08-30 21:43:55', '2020-04-01 20:55:07'),
(4, 'Admin', 'alfattah@gmail.com', 'Admin', NULL, 3, 'Admin', 2, '$2y$10$QPFPaSzVQ9NVki9O943GuO3RpY7ltC2pPz/mraYzaMFykP4M5XXsq', 1, 'HftBsS0WaFhNaeki9GEnbTOdo99h14G9dS1WtBq9AJJkzUuSyNKsUxMufhEx', '2019-04-17 01:04:35', '2020-04-01 20:54:46'),
(8, 'BIS', 'info@bis.com.bd', 'bis', 2, 1, 'Editor', 3, '$2y$10$ibfpUWm04EA6uPT8KUsjMO.71niqTARrVAGmqqnB4sSbIHHWopJ5e', 1, NULL, '2019-12-01 11:57:26', '2020-04-01 20:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) UNSIGNED NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `delivery_zone_id`, `name`, `created_at`, `updated_at`) VALUES
(5, 2, 'Merul Badda', '2020-03-03 12:10:58', '2020-03-11 07:30:36'),
(6, 2, 'DIT Project', '2020-03-03 12:11:25', '2020-03-11 07:30:44'),
(7, 2, 'Aftabnagar', '2020-03-03 12:13:54', '2020-03-11 07:30:51'),
(8, 2, 'Hossain Market', '2020-03-03 12:14:16', '2020-03-11 07:30:59'),
(9, 3, 'Mirpur 1', '2020-03-03 12:15:02', '2020-03-11 07:31:07'),
(10, 3, 'Mirpur 2', '2020-03-03 12:15:14', '2020-03-11 07:31:13'),
(11, 1, 'Azampur', '2020-03-11 07:31:23', '2020-03-11 07:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) UNSIGNED NOT NULL,
  `menuId` int(11) DEFAULT NULL,
  `parentArticle` int(11) DEFAULT NULL,
  `articleName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstHomeTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondHomeTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstInnerTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondInnerTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstHomeImage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstInnerImage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homeDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `innerDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urlLink` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `articleIcon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `articleStatus` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `menuId`, `parentArticle`, `articleName`, `firstHomeTitle`, `secondHomeTitle`, `firstInnerTitle`, `secondInnerTitle`, `firstHomeImage`, `firstInnerImage`, `homeDescription`, `innerDescription`, `urlLink`, `articleIcon`, `metaTitle`, `metaKeyword`, `metaDescription`, `orderBy`, `articleStatus`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'About Us', NULL, NULL, 'About Us', 'About Us', NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>BIS is the online platform, one of the largest retail supermarket chains in Bangladesh.&nbsp;BIS is a concern of Gemcon Group, a business entity that&rsquo;s defining the standards in innovation and service quality in the nation.</p>\r\n<p>Thanks to its fresh products, quality service and innovative organic offerings, today&nbsp;BIS stands as a leader in its sector. In order to offer the best possible price to its valuable customers, produce items are procured directly from the farmers, cutting the middlemen, while ensuring highest quality, freshness and continuous availability.</p>\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>BIS is the online platform, one of the largest retail supermarket chains in Bangladesh.&nbsp;BIS&nbsp;is a concern of Gemcon Group, a business entity that&rsquo;s defining the standards in innovation and service quality in the nation.</p>\r\n<p>Thanks to its fresh products, quality service and innovative organic offerings, today&nbsp;BIS&nbsp;stands as a leader in its sector. In order to offer the best possible price to its valuable customers, produce items are procured directly from the farmers, cutting the middlemen, while ensuring highest quality, freshness and continuous availability.</p>\r\n</body>\r\n</html>', NULL, NULL, 'about', 'ab,gggg', NULL, 1, 1, '2020-02-26 22:56:54', '2020-03-03 01:45:56'),
(2, 2, NULL, 'Frequently Asked Questions', NULL, NULL, 'Frequently Asked Questions', NULL, NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Please check the FAQs below if you are not familiar with the functions of our platform. If you are not satisfied with the answers then please call us on 01778-311111<strong>&nbsp;</strong>or write to us at&nbsp;<strong>info@bis.com.bd</strong>&nbsp;between 9 am - 10 pm every day to get our immediate help.</p>\r\n<p><strong>How do I register on BIS?</strong></p>\r\n<div class=\"panel\">\r\n<p>Simply click on Login/Signup and follow the prompts to set up a secure account.</p>\r\n</div>\r\n<p>How do I place an order on BIS?</p>\r\n<div class=\"panel\">\r\n<p>Shopping online is easy! Just follow these simple steps.</p>\r\n<p><strong>Step 1</strong></p>\r\n<p>Browse via the product categories that you can find on the left hand menu and refine your search with the search bar on the top.</p>\r\n<p><strong>Step 2</strong></p>\r\n<p>If you decide to purchase an item, add the item to your Shopping Cart by clicking the \'Add to Bag\' button. Continue shopping across our online store with brands you want.</p>\r\n<p><strong>Step 3</strong></p>\r\n<p>You can view the contents of your Shopping Cart at any time by clicking the cart icon middle-right of each page. You can proceed to &lsquo;Checkout&rsquo; if you have added all your products.</p>\r\n<p><strong>Step 4</strong></p>\r\n<p>When you are ready to purchase your items, click the \'Add to Bag\' button. This will take you to the \'Shopping Cart\' which lists all of the items you have chosen to purchase, as well as the subtotal of the cost. If any special offers are available on your chosen items, the details of these will be displayed in your \'Shopping Cart\'.</p>\r\n<p><strong>Step 5</strong></p>\r\n<p>Enter your delivery details,&nbsp;choose your delivery method, select your method of payment and click on &lsquo;Checkout&rsquo;.</p>\r\n<p><strong>Step 6</strong></p>\r\n<p>We will send you a confirmation SMS to confirm that we have received your order.</p>\r\n</div>\r\n<p><strong>I want to change my contact details, how do I do this?</strong></p>\r\n<div class=\"panel\">\r\n<p>Log into your account, click on your name on top right of any page and follow the prompts to manage your account.</p>\r\n</div>\r\n<p><strong>Why has my credit card been declined?</strong></p>\r\n<div class=\"panel\">\r\n<p>All credit and debit cardholders are subject to validation checks and authorization by the card issuer. If the issuer of your credit card refuses to or for some reason does not authorize payment to BIS Click then you will be notified of this during the checkout process. For further details of declined payments, please contact your card issuer.</p>\r\n</div>\r\n<p><strong>My order didn&rsquo;t go through, but I think you have charged me?</strong></p>\r\n<div class=\"panel\">\r\n<p>When you enter your card details to pay for your order, your bank automatically deducts the money from your available balance although it is not actually taken from your account until we dispatch your order.</p>\r\n</div>\r\n<p><strong>If I pay with my bank card and I don&rsquo;t like the product will you return money?</strong></p>\r\n<div class=\"panel\">\r\n<p>No, as the bills are already made and adjusted with the petty cash we cannot return the money; instead we will replace the product.</p>\r\n<p>If we are unable to dispatch your order, we do not charge you and the money is automatically put back onto your available balance by your Bank. This usually takes around 3 working days but the exact timeframe does depend on your card issuer and your bank.</p>\r\n<p>If this timeframe has elapsed, and the money still has not been released, please contact the Customer Service on 09678666111.</p>\r\n</div>\r\n<p><strong>What if the product I ordered is not available?</strong></p>\r\n<div class=\"panel\">\r\n<p>When you will receive a call to get a confirmation on the order you made, you will be informed that the stock has ran out for the time being. You will be suggested a replacement or a refund. But if the item is non-perishable and you would like to wait. We will be happy to be at your service.</p>\r\n</div>\r\n<p><strong>What if I am not home to receive delivery of my online order?</strong></p>\r\n<div class=\"panel\">\r\n<p>You will get a call from the outlet before making the delivery, when they call you can choose a preferable timeframe for the delivery. You can also nominate another person or have your order left unattended by providing instructions where we can leave your purchase in a secure location during checkout. Risk and title in the goods passes to the recipient upon delivery of the goods to your nominated Delivery Address.</p>\r\n</div>\r\n<p><strong>I have placed an order for someone as a gift; will they receive a proof of purchase?</strong></p>\r\n<div class=\"panel\">\r\n<p>Yes, all online orders will include a proof of purchase making refund, exchanging and warranty of the item easy for the recipient.</p>\r\n</div>\r\n<p><strong>How many hours do you need to deliver my order?</strong></p>\r\n<div class=\"panel\">\r\n<p>We will deliver within half an hour to five hours based on the time of your order (8am &ndash; 8pm). If you order after 8pm then the delivery will be on the next morning after contacting you.</p>\r\n</div>\r\n<p><strong>What is your delivery means?</strong></p>\r\n<div class=\"panel\">\r\n<p>We do our delivery using our own delivery bikes.</p>\r\n</div>\r\n<p><strong>If I don&rsquo;t like the quality of the product when you deliver will you take it back?</strong></p>\r\n<div class=\"panel\">\r\n<p>Yes, you are free to check all the products before you receive them and pay our delivery man for the purchase, if it is cash on delivery; and if any products fail to meet your requirement then we will replace it with another one or anything that you require within the price range.</p>\r\n</div>\r\n<p><strong>How will I know if the delivery is made to the right place?</strong></p>\r\n<div class=\"panel\">\r\n<p>We will confirm the order through a phone call and will also call you before making the delivery.</p>\r\n</div>\r\n<p><strong>Can I order from abroad/outside Bangladesh?</strong></p>\r\n<div class=\"panel\">\r\n<p>Yes you can order from anywhere in the world and we will deliver your required products within our jurisdiction within the specified time frame. In this case please mention the contact details of the person who will receive your order.</p>\r\n</div>\r\n<p><strong>Is the price mentioned on the website more than that of the outlets?</strong></p>\r\n<div class=\"panel\">\r\n<p>No, all the products are sold at MRP, so you will find the same in our website, and in our outlets.</p>\r\n</div>\r\n<p><strong>I am a club card member; will I get point for my online purchase?</strong></p>\r\n<div class=\"panel\">\r\n<p>Yes, of course! Just put your barcode no/customer ID no. in the comment box, we will add up the points in your account.</p>\r\n</div>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 2, 1, '2020-02-26 22:57:28', '2020-03-07 04:03:49'),
(3, 3, NULL, 'Terms and Conditions', NULL, NULL, 'Terms and Conditions', 'Terms and Conditions', NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p><strong>General</strong></p>\r\n<p>BIS&nbsp;is a shopping platform&nbsp;where you can browse, select and order products advertised.</p>\r\n<p><strong>Agreement to the terms and conditions</strong></p>\r\n<p>By accessing and using the site, including placing orders of products through the site, you agree that you will be subject to and will comply with these terms and conditions</p>\r\n<p>(a) By completing your registration through the site; and</p>\r\n<p>(b) Using the site to obtain products from us.</p>\r\n<p><strong>Registration</strong></p>\r\n<p>You must complete the customer registration process through the site before placing an order for products through the site.</p>\r\n<p>You may not have more than one active account, and your account is non-transferable. You may update, edit or terminate your account at any time through the site. You may not have more than two accounts per delivery address.</p>\r\n<p>If you choose to use a workplace email address for your account or to access the site, then you are solely responsible for ensuring that you comply with the rules, policies or protocols that apply to the use of your email address and your workplace facilities.</p>\r\n<p><strong>Placing an Order for Products</strong></p>\r\n<p>You may order products by selecting and submitting your order through the site.</p>\r\n<p>Any order placed through this site for a product is an offer by you to purchase the particular product for the price notified (including the delivery and other charges and taxes) at the time you place the order.</p>\r\n<p>We may ask you to provide additional details or require you to confirm your details to enable us to process any orders placed through the site.</p>\r\n<p>You agree to provide us with current, complete and accurate details when asked to do so by the site.</p>\r\n<p><strong>Cancellation Policy</strong></p>\r\n<p>We reserve the right to accept or reject your order for any reason, including if the requested product is not available, if there is an error in the price or the product description posted on the site or an error in your order. We also reserve the right to cancel any order without giving any reason(s). We also have the right to suspend or remove an user account without giving any notice or justification to the user. We will keep every unverified order for 6 (six) hours and make several attempts to verify. If there is&nbsp; no response, after that time the order will be automatically canceled.</p>\r\n<p><strong>Delivery of Products</strong></p>\r\n<p>We will only deliver products ordered through the site to a location where we provide delivery services. You may obtain further information on the site about our delivery timeframes and how we deliver your products.</p>\r\n<p>We will deliver the products to the front door at the relevant delivery address. If you ask us to deliver inside a premise or building at the delivery address and we agree to do so, then you are responsible for all loss or damage suffered by us in connection with our delivery of the products beyond the front door of the delivery address.</p>\r\n<p>You agree to comply with certain delivery requirements specified below and such other requirements that we notify to you when you place your order through the site.</p>\r\n<p>If you are not be the person collecting your grocery order then your representative must provide us with proof of their identity.</p>\r\n<p>You acknowledge that we may record the details of any identification provided in relation to collection of products.</p>\r\n<p><strong>Refund Policy</strong></p>\r\n<p>If you have made online pre-payment/card payment against your order, and there are product/s which is/are not available in stock, we will offer you product replacement options within the same price range. If, for any reason, you decline to take product replacements, then the order will be cancelled and we will start the refund process. Please make sure to make your refund request by calling our helpline at 09678666111. BIS will retain full right over the refund payment medium, given that it reaches you in correct amount. The refund process will usually take approximately 28 banking days to complete from refund request date. That means you will receive your refund within 28 banking days of conveying the refund request through our call center helpline.</p>\r\n<p><strong>Product Promotions Policy</strong></p>\r\n<p>Please note that the delivery of promotional product or product with special offer is subject to stock availability. If the product is out of stock, then we request you to&nbsp;<em>replace with</em>&nbsp;another product which is&nbsp;<em>in stock</em>. You may also cancel the order if you want.</p>\r\n<p><strong>Order Policy</strong></p>\r\n<p>There will be order limits set for certain products to ensure every customer can avail the necessary products for daily consumption. BIS is not a marketplace for business to business (B2B) transactions. It is instead an online shopping platform for personal consumption and usage. Thus, we highly discourage shopping with reselling or commercial motives.</p>\r\n<p><strong>Regarding BIS Bazar Club Cards</strong><br /><br />Club Card is a property of BIS Bazar store and can be used to earn and redeem points only at physical stores.</p>\r\n<p><strong>Return Policy</strong></p>\r\n<p>The following are the conditions for product returns:</p>\r\n<ul>\r\n<li>Customer can return the products within 7 days from purchase date</li>\r\n<li>The product must be unused, unworn, unwashed and without any flaws. Fashion products can be tried on to see if they fit and will still be considered unworn. If a product is returned to us in an inadequate condition, we reserve the right to send it back to you.</li>\r\n<li>The product must include the original tags, user manual, warranty cards, freebies and/or accessories.</li>\r\n<li>The product must be returned in the original and undamaged manufacturer packaging/box. If the product was delivered in a second layer of BIS packaging, it must be returned in the same condition with return shipping label attached.</li>\r\n</ul>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 3, 1, '2020-02-26 22:58:04', '2020-03-07 03:54:08'),
(4, 4, NULL, 'Privacy Policy', NULL, NULL, 'Privacy Policy', 'Privacy Policy', NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>This Privacy Policy manages the manner in which BIS collects, uses, maintains and discloses information collected from users (each, a \"User\") of the www.BIS.com website (\"Site\"). This privacy policy is applicable for the Site with all products and services offered by BIS.</p>\r\n<p><strong>Personal Identification Information</strong></p>\r\n<ul>\r\n<li><strong>Information customers give us:</strong></li>\r\n</ul>\r\n<p>We may collect personal identification information from users in different ways, like, when users visit our site, register on the site, place an order, fill out a form, respond to a survey, subscribe to the newsletter and in connects with other activities, services, features or resources we have on our site.</p>\r\n<ul>\r\n<li><strong>What kind of information:</strong></li>\r\n</ul>\r\n<p>Users may be asked for, name, email address, mailing address, phone number, debit/credit card information etc. when required. Whenever the users interact with our website we get information like their browser names, device type, the means of connection with our site, their internet connection details and other similar information.</p>\r\n<ul>\r\n<li><strong>Automatic Information (Cookies):</strong></li>\r\n</ul>\r\n<p>We receive and store certain types of information whenever the user interacts with us. For example, like many web sites, we use \"cookies,\" to enhance user experience. The user may choose to set their web browser to refuse cookies, or to alert them when cookies are being sent. If they do so, note that some parts of the site may not function properly.</p>\r\n<ul>\r\n<li><strong>Mobile:</strong></li>\r\n</ul>\r\n<p>When the users downloads or use our BIS Shopping app, we may receive information about their location and mobile device, including a unique identifier for that device. We may use this information to provide the users with location-based services, such as advertising, search results, and other personalized content. Most mobile devices allow turning off location services, so if it bothers the user, they can turn it off.</p>\r\n<ul>\r\n<li><strong>E-mail Communications:</strong></li>\r\n</ul>\r\n<p>We get the users email addresses when they place an order through our website. We send our newsletter and different offers according to the customer profile to them. If the user does not want to receive e-mail or other mail from us, they can unsubscribe easily.</p>\r\n<ul>\r\n<li><strong>Payment:</strong></li>\r\n</ul>\r\n<p>If you have already made payment twice for your single purchase then please contact your bank to reverse the payment or cancel the payment as in BIS we have no control or access to your payments. Your payment related information is also kept secret to us from bank. During payment process if you get disconnected then please contact your bank to ensure if the payment went through or not, if not then please make the payment again.</p>\r\n<p><strong>How we use these information?</strong></p>\r\n<p>BIS collects and uses Users personal information for the following purposes:</p>\r\n<ul>\r\n<li><strong>To improve customer service:</strong></li>\r\n</ul>\r\n<p>Your information helps us to more effectively respond to your customer service requests and support needs.</p>\r\n<ul>\r\n<li><strong>To improve our Site:</strong></li>\r\n</ul>\r\n<p>We continually strive to improve our website offerings based on the information and feedback we receive from you.</p>\r\n<ul>\r\n<li><strong>To process transactions:</strong></li>\r\n</ul>\r\n<p>We may use the information users provide only to respond to their product requests. We do not share this information with anyone else except to the extent necessary to provide the service.</p>\r\n<ul>\r\n<li><strong>To send periodic emails:</strong></li>\r\n</ul>\r\n<p>The email address Users provide us for order processing, will only be used to send them information and updates related to their order. It may also be used to respond to their inquiries, and/or other requests or questions. If User decides to opt-in to our mailing list, they will receive emails that may include company news, updates, related product or service information, etc. If at any time the User would like to unsubscribe from receiving future emails, we include detailed unsubscribe instructions at the bottom of each email or User may contact us via our Site.</p>\r\n<p><strong>How we protect your information?</strong></p>\r\n<p>We adopt appropriate data collection, storage and processing practices and security measures to protect against unauthorized access, alteration, disclosure or destruction of your personal information, username, password, transaction information and data stored on our Site.</p>\r\n<p><strong>Changes to this privacy policy</strong></p>\r\n<p>BIS has the discretion to update this privacy policy at any time. When we do, revise the updated date at the bottom of this page, send you an email. We encourage Users to frequently check this page for any changes to stay informed about how we are helping to protect the personal information we collect.</p>\r\n<p><strong>Your acceptance of these terms</strong></p>\r\n<p>By using this Site, you signify your acceptance of this policy and terms of service. If you do not agree to this policy, please do not use our Site.</p>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 4, 1, '2020-02-26 22:58:34', '2020-03-07 03:56:41'),
(5, 5, NULL, 'Shipping and Delivery', NULL, NULL, 'Shipping and Delivery', 'Shipping and Delivery', NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>We have our own delivery system and we have our trained delivery personnel with bikes who are dedicated to deliver any type of goods to your doorsteps.</p>\r\n<p><u><strong>Delivery Modality</strong></u></p>\r\n<p>Convenient Delivery:</p>\r\n<p>We offer you convenience through our efficient delivery system. You will have the option to select the preferred timing of delivery of your desired goods. You only need to select your preferred date and time and the goods will be at your doorstep. In case your preferred delivery slot is booked, you can just select the next slot that is just 2 hours later.</p>\r\n<p>Pick From store:</p>\r\n<p>You can always choose to pick the goods from your selected stores. To order online, select the &ldquo;pick from store&rdquo; option, and pick the goods you want to have delivered to your home with the click of a few buttons.</p>\r\n<p><u><strong>Delivery Charges</strong></u></p>\r\n<p>Convenient Delivery Charge: 15 Taka</p>\r\n<p>Pick from Store: Free</p>\r\n<p>Any Convenient delivery with a basket value of BDT 800 and above will get free Delivery.</p>\r\n<p><u><strong>Delivery Disclaimer</strong></u></p>\r\n<p>For various reasons such as weather conditions, traffic congestions, product sourcing delay etc. delivery may be delayed from the selected delivery slot time. In such unavoidable circumstances, whereby delivery is delayed even after taking all due care, BIS will hold no liability.</p>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 5, 1, '2020-02-26 22:59:31', '2020-03-07 03:59:28'),
(6, 6, NULL, 'Customer Care', NULL, NULL, 'Customer Care', 'Customer Care', NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div class=\"row mt-4\">\r\n<div class=\"col-md-12 text-center\">\r\n<h4 class=\"p-2\">The way we grow our products is more important than the way it look. We provide you the best products with delivery support country-wide with 24x7 live support online and offline both!</h4>\r\n</div>\r\n</div>\r\n<div class=\"row mt-2\">\r\n<div class=\"col-md-6\">\r\n<h6>CUSTOMER CARE</h6>\r\n<p>Our Customer Care team is available from 9AM-10PM at the following avenues:</p>\r\n<p><strong>Hotline Number:</strong>&nbsp;09 678 666 111</p>\r\n<p><strong>Email Address:</strong>&nbsp;:&nbsp;info@bis.com.bd</p>\r\n</div>\r\n</div>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 6, 1, '2020-02-26 22:59:55', '2020-03-07 04:02:45'),
(7, 7, NULL, 'Careers', NULL, NULL, 'Careers', 'Careers', NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p><strong>We are BIS.</strong></p>\r\n<p><strong>One of the leading e-Commerce grocery stores in Bangladesh.</strong></p>\r\n<p>If you ever visit our corporate office in the center of the capital city, the first thing you will feel is the enthusiasm. Our teams are outgoing, self-motivated and winning. If energy, action and success motivates you, our work environment will be a perfect fit.</p>\r\n<p>If you are interested in being extraordinary, creating history and being part of the team that is building the largest e-commerce grocery store in Bangladesh, then please email us your CV to&nbsp;<strong>info@bis.com.bd</strong>. We\'ll get back to you if you are the right fit!</p>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 7, 1, '2020-02-26 23:00:21', '2020-03-07 04:01:37'),
(8, 8, NULL, 'Order History', 'Order History', NULL, NULL, NULL, NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-03-07 04:04:36', '2020-03-07 04:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bannerImage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urlLink` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bannerStatus` tinyint(1) NOT NULL,
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `bannerImage`, `urlLink`, `bannerStatus`, `metaTitle`, `metaKeyword`, `metaDescription`, `orderBy`, `created_at`, `updated_at`) VALUES
(1, 'Banner 1', 'images/banners/electronics-items-shopnobari-online-shopping-in-bangladesh_175173106505.jpg', NULL, 1, NULL, NULL, NULL, 1, '2020-03-05 02:57:50', '2020-03-05 02:57:50'),
(2, 'Banner 2', 'images/banners/Personal-Care-Products_12045816774.jpg', NULL, 1, NULL, NULL, NULL, 2, '2020-03-05 03:02:38', '2020-03-05 03:02:38');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstHomeTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondHomeTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstInnerTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondInnerTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstHomeImage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstInnerImage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homeDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `innerDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urlLink` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `articleIcon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `articleStatus` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `firstHomeTitle`, `secondHomeTitle`, `firstInnerTitle`, `secondInnerTitle`, `firstHomeImage`, `firstInnerImage`, `homeDescription`, `innerDescription`, `urlLink`, `articleIcon`, `metaTitle`, `metaKeyword`, `metaDescription`, `orderBy`, `articleStatus`, `created_at`, `updated_at`) VALUES
(6, 'We Are Provide Best Product', NULL, 'We Are Provide Best Product', NULL, 'public/uploads/blogs/home/ak-img-1_196494918527.jpg', 'public/uploads/blogs/inner_page/01-img_152047098059.jpg', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p><span style=\"color: #000000;\">Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur&nbsp;</span></p>\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</p>\r\n<p>Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 1, 0, '2020-01-21 03:59:04', '2020-02-14 23:59:32'),
(7, 'We are going to arrange seminar', 'We are going to arrange seminar', 'We are going to arrange seminar', 'We are going to arrange seminar', 'public/uploads/blogs/home/2_22039520936.jpg', 'public/uploads/blogs/inner_page/02-img_30087381611.jpg', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas</p>\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</p>\r\n<p>Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 2, 0, '2020-01-21 04:01:53', '2020-02-14 23:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `cash_purchase`
--

CREATE TABLE `cash_purchase` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `cash_serial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voucher_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `voucher_date` datetime DEFAULT NULL,
  `total_qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `voucherStatus` int(11) DEFAULT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cash_purchase`
--

INSERT INTO `cash_purchase` (`id`, `type`, `cash_serial`, `voucher_no`, `supplier_id`, `voucher_date`, `total_qty`, `total_amount`, `orderBy`, `voucherStatus`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(2, 'cash', '1000002', '675878854', 1, '2020-03-12 00:00:00', '15.00', '4400.00', NULL, NULL, 2, '2020-03-11 22:48:31', '2020-03-11 22:48:31');

-- --------------------------------------------------------

--
-- Table structure for table `cash_purchase_item`
--

CREATE TABLE `cash_purchase_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `cash_puchase_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cash_purchase_item`
--

INSERT INTO `cash_purchase_item` (`id`, `cash_puchase_id`, `product_id`, `qty`, `rate`, `amount`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '5', '350', '1750.00', NULL, '2020-01-22 17:39:58', '2020-01-22 17:39:58'),
(2, 1, 18, '10', '250', '2500.00', NULL, '2020-01-22 17:39:58', '2020-01-22 17:39:58'),
(3, 2, 1, '10', '250', '2500.00', 2, '2020-03-11 22:48:31', '2020-03-11 22:48:31'),
(4, 2, 3, '5', '380', '1900.00', 2, '2020-03-11 22:48:31', '2020-03-11 22:48:31');

-- --------------------------------------------------------

--
-- Table structure for table `cash_sales`
--

CREATE TABLE `cash_sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_no` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_date` datetime NOT NULL,
  `invoice_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_as` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `net_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_paid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `change_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cash_sales`
--

INSERT INTO `cash_sales` (`id`, `invoice_no`, `invoice_date`, `invoice_amount`, `discount_as`, `discount_amount`, `vat_amount`, `net_amount`, `customer_paid`, `change_amount`, `payment_type`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(1, '0000-0000-0001', '2020-03-11 00:00:00', '5000.00', NULL, NULL, '225.00', '5225.00', '1000', '-4225.00', 'Cash', NULL, '2020-03-11 05:56:52', '2020-03-11 05:56:52'),
(2, '0000-0000-0002', '2020-03-12 00:00:00', '2500.00', NULL, NULL, '112.50', '2612.50', '1000', '-1612.50', 'Cash', NULL, '2020-03-12 01:46:35', '2020-03-12 01:46:35'),
(3, '0000-0000-0003', '2020-03-12 00:00:00', '14000.00', NULL, NULL, '630.00', '14630.00', '9000', '-5630.00', 'Cash', 2, '2020-03-12 01:48:03', '2020-03-12 01:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `cash_sale_items`
--

CREATE TABLE `cash_sale_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `cash_sale_id` int(11) NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cash_sale_items`
--

INSERT INTO `cash_sale_items` (`id`, `cash_sale_id`, `invoice_no`, `item_id`, `item_quantity`, `item_rate`, `item_price`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(1, 2, '0000-0000-0002', 7, '10', '250', '2500.00', NULL, '2020-03-12 01:46:35', '2020-03-12 01:46:35'),
(2, 3, '0000-0000-0003', 6, '20', '700', '14000.00', 2, '2020-03-12 01:48:03', '2020-03-12 01:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `categoryName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `headerImage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `originalImage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `showInHomepage` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `showInHomeCategoryProduct` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `showInHomeCategoryProductWithSubcategory` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `showInHomeCategoryProductWithProduct` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `categoryStatus` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent`, `categoryName`, `headerImage`, `originalImage`, `image`, `icon`, `showInHomepage`, `showInHomeCategoryProduct`, `showInHomeCategoryProductWithSubcategory`, `showInHomeCategoryProductWithProduct`, `metaTitle`, `metaKeyword`, `metaDescription`, `orderBy`, `categoryStatus`, `created_at`, `updated_at`) VALUES
(9, NULL, 'Electronics', NULL, 'images/categories/original_image/electronics-items-shopnobari-online-shopping-in-bangladesh_15119085636.jpg', 'images/categories/image/electronics-items-shopnobari-online-shopping-in-bangladesh_85014458654.jpg', NULL, '1', '0', '1', '0', NULL, NULL, NULL, 2, 1, '2020-02-23 01:03:47', '2020-03-02 05:26:38'),
(10, NULL, 'Laptop and Computer', NULL, 'images/categories/original_image/desktop-computers-500x500_47739559391.jpg', 'images/categories/image/desktop-computers-500x500_40141158397.jpg', NULL, '1', '0', '0', '0', NULL, NULL, NULL, 5, 1, '2020-02-23 01:03:58', '2020-03-02 07:10:51'),
(13, NULL, 'Women\'s Fashion', 'images/categories/header_image/download_95134953599.png', 'images/categories/original_image/download (1)_50301507720.jpg', 'images/categories/image/download (1)_85930543534.jpg', '<i class=\"fa fa-shopping-cart\"></i>', '1', '0', '0', '0', NULL, NULL, NULL, 6, 1, '2020-02-23 01:05:31', '2020-03-02 07:14:01'),
(14, NULL, 'Personal Care', NULL, 'images/categories/original_image/download (3)_96148399616.jpg', 'images/categories/image/download (3)_27509434498.jpg', NULL, '1', '0', '0', '1', NULL, NULL, NULL, 1, 1, '2020-02-23 01:06:08', '2020-03-02 05:13:01'),
(15, 13, 'Bags', NULL, 'images/categories/original_image/81fApue+UdL._UL1500__43109550113.jpg', 'images/categories/image/81fApue+UdL._UL1500__80202737325.jpg', '<i class=\"fa fa-fish\"></i>', '1', '0', '0', '0', NULL, NULL, NULL, 1, 1, '2020-02-23 03:22:08', '2020-03-02 07:07:18'),
(16, 9, 'Kitchen Appliances', NULL, 'images/categories/original_image/Electric-Kitchen-Appliances-Market-780x330_30487190201.jpg', 'images/categories/image/Electric-Kitchen-Appliances-Market-780x330_73305553881.jpg', NULL, '0', '0', '0', '0', NULL, NULL, NULL, 1, 1, '2020-02-24 02:42:53', '2020-03-07 18:14:29'),
(17, 9, 'Home Appliances', NULL, 'images/categories/original_image/download (2)_85605676339.jpg', 'images/categories/image/download (2)_57931783509.jpg', NULL, '1', '0', '0', '0', NULL, NULL, NULL, 2, 1, '2020-02-24 02:43:21', '2020-03-02 06:17:43'),
(18, 9, 'Televisions', NULL, 'images/categories/original_image/3A--CDT--Televisions_63749417334.jpg', 'images/categories/image/3A--CDT--Televisions_39763694958.jpg', NULL, '0', '0', '0', '0', NULL, NULL, NULL, 3, 1, '2020-02-24 02:43:48', '2020-03-07 18:15:59'),
(19, NULL, 'Mobiles and Tablets', NULL, 'images/categories/original_image/data-recovery-tablet-phone-800x600_67811675313.jpg', 'images/categories/image/data-recovery-tablet-phone-800x600_12883788872.jpg', NULL, '1', '0', '0', '0', NULL, NULL, NULL, 3, 1, '2020-02-29 16:21:57', '2020-03-02 07:08:50'),
(20, NULL, 'Men\'s Fashion', NULL, 'images/categories/original_image/download (2)_60298500424.jpg', 'images/categories/image/download (2)_40982071889.jpg', NULL, '1', '0', '0', '0', NULL, NULL, NULL, 7, 1, '2020-02-29 16:29:44', '2020-03-02 07:14:37'),
(21, NULL, 'Computer Accessories', NULL, NULL, NULL, NULL, '0', '1', '0', '0', NULL, NULL, NULL, 4, 1, '2020-02-29 06:25:25', '2020-03-02 05:28:47'),
(22, NULL, 'Home and Living', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 8, 1, '2020-03-02 05:37:52', '2020-03-02 05:37:52'),
(23, NULL, 'Baby Happiness', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 9, 1, '2020-03-02 05:38:28', '2020-03-02 05:38:28'),
(24, NULL, 'Islamic Accessories', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 10, 1, '2020-03-02 05:38:56', '2020-03-02 05:38:56'),
(25, 14, 'Health', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 1, 1, '2020-03-02 06:03:03', '2020-03-02 06:03:03'),
(26, 14, 'Beauty', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 2, 1, '2020-03-02 06:05:27', '2020-03-02 06:05:27'),
(27, 14, 'Sanitary Napkins', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 3, 1, '2020-03-02 06:05:55', '2020-03-02 06:05:55'),
(28, NULL, 'Dental Care', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 4, 1, '2020-03-02 06:06:40', '2020-03-02 06:06:40'),
(29, 14, 'Soap Bar', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 5, 1, '2020-03-02 06:07:01', '2020-03-02 06:07:30'),
(30, 9, 'Electronics Accessories', NULL, 'images/categories/original_image/electronics-items-shopnobari-online-shopping-in-bangladesh_12820668362.jpg', 'images/categories/image/electronics-items-shopnobari-online-shopping-in-bangladesh_88996124528.jpg', NULL, '0', '0', '0', '0', NULL, NULL, NULL, 4, 1, '2020-03-02 06:18:37', '2020-03-07 18:16:29'),
(31, 9, 'Blender', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 5, 1, '2020-03-02 06:19:27', '2020-03-02 06:19:27'),
(32, 9, 'Grinder', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 6, 1, '2020-03-02 06:21:28', '2020-03-02 06:21:28'),
(33, 9, 'Mixer', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 7, 1, '2020-03-02 06:22:01', '2020-03-02 06:22:01'),
(34, NULL, 'Rice Cooker', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 8, 1, '2020-03-02 06:22:25', '2020-03-02 06:22:25'),
(35, 9, 'CCTV Camera', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 9, 1, '2020-03-02 06:23:33', '2020-03-02 06:23:56'),
(36, 9, 'Online TV', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 10, 1, '2020-03-02 06:24:59', '2020-03-02 06:24:59'),
(37, 19, 'Mobile Accessories', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 1, 1, '2020-03-02 06:33:36', '2020-03-02 06:33:36'),
(38, 19, 'Earphones', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 2, 1, '2020-03-02 06:34:02', '2020-03-02 06:34:02'),
(39, 19, 'Mobile', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 3, 1, '2020-03-02 06:34:41', '2020-03-02 06:34:41'),
(40, 19, 'Mobiles Cover', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 4, 1, '2020-03-02 06:35:09', '2020-03-02 06:35:09'),
(41, 19, 'Screen Protector', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 5, 1, '2020-03-02 06:35:41', '2020-03-02 06:35:41'),
(42, 21, 'Speaker', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 1, 1, '2020-03-02 06:37:36', '2020-03-02 06:37:36'),
(43, 21, 'Mouse', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 2, 1, '2020-03-02 06:37:53', '2020-03-02 06:37:53'),
(44, 21, 'Keyboard', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 3, 1, '2020-03-02 06:38:12', '2020-03-02 06:38:12'),
(45, 21, 'Pen Drive', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 4, 1, '2020-03-02 06:38:58', '2020-03-02 06:38:58'),
(46, 10, 'Dell', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 1, 1, '2020-03-02 06:39:32', '2020-03-02 06:39:32'),
(47, 10, 'HP', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 2, 1, '2020-03-02 06:39:50', '2020-03-02 06:39:50'),
(48, 10, 'Acer', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 3, 1, '2020-03-02 06:40:20', '2020-03-02 06:40:20'),
(49, 10, 'Asus', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 4, 1, '2020-03-02 06:40:37', '2020-03-02 06:40:37'),
(50, 10, 'Apple', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 5, 1, '2020-03-02 06:40:59', '2020-03-02 06:40:59'),
(51, 10, 'Lenovo', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 6, 1, '2020-03-02 06:41:18', '2020-03-02 06:41:18'),
(52, 10, 'Sony', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 7, 1, '2020-03-02 06:41:33', '2020-03-02 06:41:33'),
(53, 10, 'Toshiba', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 8, 1, '2020-03-02 06:41:55', '2020-03-02 06:41:55'),
(54, 10, 'MSI', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 9, 1, '2020-03-02 06:42:15', '2020-03-02 06:42:15'),
(55, 10, 'Samsung', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 10, 1, '2020-03-02 06:42:34', '2020-03-02 06:42:34'),
(56, 13, 'Clothing (unstitched)', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 2, 1, '2020-03-02 06:48:31', '2020-03-02 06:48:31'),
(57, 13, 'Lingerie, Sleep, Lounge', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 3, 1, '2020-03-02 06:50:32', '2020-03-02 06:50:32'),
(58, 13, 'Kurti', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 4, 1, '2020-03-02 06:50:53', '2020-03-02 06:50:53'),
(59, 13, 'Shari', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 5, 1, '2020-03-02 06:51:10', '2020-03-02 06:51:10'),
(60, 13, 'Women Socks', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 6, 1, '2020-03-02 06:51:47', '2020-03-02 06:51:47'),
(61, 13, 'Shoes', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 7, 1, '2020-03-02 06:52:14', '2020-03-02 06:52:14'),
(62, 13, 'Watches', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 8, 1, '2020-03-02 06:52:32', '2020-03-02 06:52:32'),
(63, 20, 'Watches', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 1, 1, '2020-03-02 06:52:53', '2020-03-02 06:52:53'),
(64, 13, 'Shirt', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 2, 1, '2020-03-02 06:53:12', '2020-03-02 06:53:12'),
(65, 20, 'T-Shirt', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 3, 1, '2020-03-02 06:53:25', '2020-03-02 06:54:36'),
(66, 20, 'Polo Shirt', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 4, 1, '2020-03-02 06:53:49', '2020-03-02 06:53:49'),
(67, 20, 'Bags', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 5, 1, '2020-03-02 06:55:04', '2020-03-02 06:55:04'),
(68, 20, 'Belt', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 6, 1, '2020-03-02 06:55:22', '2020-03-02 06:56:01'),
(69, 20, 'Wallet', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 7, 1, '2020-03-02 06:55:40', '2020-03-02 06:55:40'),
(70, 20, 'Jeans', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 8, 1, '2020-03-02 06:56:24', '2020-03-02 06:56:24'),
(71, 20, 'Jacket', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 9, 1, '2020-03-02 06:56:43', '2020-03-02 06:56:43'),
(72, 20, 'Shoes', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 10, 1, '2020-03-02 06:57:06', '2020-03-02 06:57:06'),
(73, 20, 'Socks', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 11, 1, '2020-03-02 06:57:22', '2020-03-02 06:57:22'),
(74, 20, 'Caps', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 12, 1, '2020-03-02 06:57:46', '2020-03-02 06:58:04'),
(75, 20, 'Sunglasses', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 13, 1, '2020-03-02 06:58:48', '2020-03-02 06:58:48'),
(76, 22, 'Bed Sheet', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 1, 1, '2020-03-02 06:59:21', '2020-03-02 06:59:21'),
(77, 22, 'Floor Mate', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 2, 1, '2020-03-02 06:59:40', '2020-03-02 06:59:40'),
(78, 22, 'Blanket', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 3, 1, '2020-03-02 06:59:56', '2020-03-02 06:59:56'),
(79, 22, 'Luggage', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 4, 1, '2020-03-02 07:00:11', '2020-03-02 07:00:11'),
(80, 23, 'Baby Food', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 1, 1, '2020-03-02 07:00:32', '2020-03-02 07:00:32'),
(81, 23, 'Nappies and Wipes', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 2, 1, '2020-03-02 07:00:58', '2020-03-02 07:00:58'),
(82, 23, 'Bath and Skin Care', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 3, 1, '2020-03-02 07:01:25', '2020-03-02 07:01:25'),
(83, 23, 'Baby Oral Care', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 4, 1, '2020-03-02 07:01:42', '2020-03-02 07:01:42'),
(84, 24, 'Attar', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 1, 1, '2020-03-02 07:03:53', '2020-03-02 07:03:53'),
(85, 24, 'Muslim Cape', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 2, 1, '2020-03-02 07:04:20', '2020-03-02 07:04:20'),
(86, 24, 'Tasbih', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 3, 1, '2020-03-02 07:04:43', '2020-03-02 07:04:43'),
(87, 24, 'Prayer Mat', NULL, NULL, NULL, NULL, '0', '0', '0', '0', NULL, NULL, NULL, 4, 1, '2020-03-02 07:05:25', '2020-03-02 07:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `client_entries`
--

CREATE TABLE `client_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` datetime NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `client_statement_report`
-- (See below for the actual view)
--
CREATE TABLE `client_statement_report` (
`customerId` varchar(255)
,`type` varchar(255)
,`date` datetime
,`sales` varchar(255)
,`collection` int(11)
,`others` int(1)
,`delivery_zone_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `contactName` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactPhone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactEmail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactAddress` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactMessage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contactuses`
--

CREATE TABLE `contactuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new-message',
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_collections`
--

CREATE TABLE `credit_collections` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `payment_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` datetime NOT NULL,
  `money_receipt_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `money_receipt_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit_collections`
--

INSERT INTO `credit_collections` (`id`, `client_id`, `payment_no`, `payment_date`, `money_receipt_no`, `money_receipt_type`, `payment_amount`, `remarks`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(1, 1, '0000-0000-0001', '2020-03-11 00:00:00', '5465465657', 'Cash', 100, NULL, NULL, '2020-03-11 06:07:12', '2020-03-11 06:07:12'),
(2, 1, '0000-0000-0002', '2020-03-12 00:00:00', '4567567757', 'Cash', 5000, 'dfgfjhjhjh', 2, '2020-03-12 01:57:05', '2020-03-12 01:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `credit_purchases`
--

CREATE TABLE `credit_purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'credit',
  `credit_serial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vouchar_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `submission_date` datetime NOT NULL,
  `purchase_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voucher_date` datetime NOT NULL,
  `total_qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `net_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit_purchases`
--

INSERT INTO `credit_purchases` (`id`, `type`, `credit_serial`, `vouchar_no`, `supplier_id`, `submission_date`, `purchase_by`, `voucher_date`, `total_qty`, `total_amount`, `discount`, `vat`, `net_amount`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(2, 'credit', '1000002', '645756756756', 1, '2020-03-12 00:00:00', 'BIS', '2020-03-12 00:00:00', '18.00', '3900.00', '0', '0', '3900.00', 2, '2020-03-11 23:01:33', '2020-03-11 23:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `credit_purchase_items`
--

CREATE TABLE `credit_purchase_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `credit_puchase_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit_purchase_items`
--

INSERT INTO `credit_purchase_items` (`id`, `credit_puchase_id`, `product_id`, `qty`, `rate`, `amount`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '5', '200', '1000.00', NULL, NULL, NULL),
(2, 2, 4, '10', '150', '1500.00', 2, NULL, NULL),
(3, 2, 7, '8', '300', '2400.00', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credit_sales`
--

CREATE TABLE `credit_sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_date` datetime NOT NULL,
  `invoice_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_as` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `net_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit_sales`
--

INSERT INTO `credit_sales` (`id`, `customer_id`, `invoice_no`, `invoice_date`, `invoice_amount`, `discount_as`, `discount_amount`, `vat_amount`, `net_amount`, `payment_type`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(1, '1', '0000-0000-0001', '2020-03-12 00:00:00', '15000.00', NULL, NULL, '675.00', '15675.00', 'Credit', 2, '2020-03-12 01:51:21', '2020-03-12 01:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `credit_sale_items`
--

CREATE TABLE `credit_sale_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `credit_sale_id` int(11) NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit_sale_items`
--

INSERT INTO `credit_sale_items` (`id`, `credit_sale_id`, `invoice_no`, `item_id`, `item_quantity`, `item_rate`, `item_price`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(1, 1, '0000-0000-0001', '16', '50', '300', '15000.00', 2, '2020-03-12 01:51:21', '2020-03-12 01:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmPassword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clientGroup` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `verify_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `mobile`, `dob`, `address`, `gender`, `password`, `confirmPassword`, `clientGroup`, `delivery_zone_id`, `verify_token`, `created_at`, `updated_at`) VALUES
(1, 'Techno Park', 'jisanahmed06@gmail.com', '232435436456', NULL, 'Road:9', NULL, NULL, NULL, NULL, NULL, NULL, '2020-03-11 04:25:13', '2020-05-01 18:50:37'),
(2, 'Mahedy Hasan', 'mahedy@gmail.com', '018676886', NULL, 'Uttara', NULL, NULL, NULL, NULL, NULL, NULL, '2020-03-11 04:31:40', '2020-03-11 04:31:40'),
(3, 'Hhd', 'khan@gmail.com', '0179849317', NULL, 'Hdjjdjd', NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-07 06:59:07', '2020-09-07 06:59:07'),
(4, 'creative software', 'ghoshsampa21@gmail.com', '01318712782', NULL, 'Mirpur -13,Road-4 Dhaka', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2020-09-07 17:42:22', '2020-09-13 05:46:28'),
(5, 'Cyan Group', 'abu.sayeed.diu@gmail.com', '01318712782', NULL, 'mirpur 1212 housekk', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '2020-09-07 17:42:22', '2020-09-07 17:42:22'),
(6, 'Kawsar Ahmed Parvez', 'ed@kitesfashion.com', '+8801312451911', NULL, 'La-Montana,House:33,Sector:11,Road:Gareeb-e-newaz,Uttara,Dhaka-1230,Bangladesh.', NULL, '73772ba6483341303ba2cfb69bbe2b3e', '73772ba6483341303ba2cfb69bbe2b3e', NULL, NULL, NULL, '2020-09-07 20:05:29', '2020-09-07 20:05:29'),
(7, 'Md. Rafael Hossen', 'step2omi@gmail.com', '01682960040', NULL, '53/Cha, Kalaghata Road, Bandarban Sadar-4000, Bandarban, Chittagong', NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-16 08:05:38', '2020-09-16 08:05:38');

-- --------------------------------------------------------

--
-- Table structure for table `customer_groups`
--

CREATE TABLE `customer_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `groupName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `groupCode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `groupStatus` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_groups`
--

INSERT INTO `customer_groups` (`id`, `groupName`, `groupCode`, `metaTitle`, `metaKeyword`, `metaDescription`, `orderBy`, `groupStatus`, `created_at`, `updated_at`) VALUES
(1, 'Reseller', 'R001', NULL, NULL, NULL, 1, 1, '2019-12-02 14:18:02', '2019-12-02 14:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `customer_group_sections`
--

CREATE TABLE `customer_group_sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `customerGroupId` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customerGroupPrice` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_group_sections`
--

INSERT INTO `customer_group_sections` (`id`, `productId`, `customerGroupId`, `customerGroupPrice`, `created_at`, `updated_at`) VALUES
(9, 59, NULL, NULL, NULL, NULL),
(14, 58, NULL, NULL, NULL, NULL),
(15, 53, NULL, NULL, NULL, NULL),
(17, 41, NULL, NULL, NULL, NULL),
(19, 48, NULL, NULL, NULL, NULL),
(20, 29, NULL, NULL, NULL, NULL),
(21, 60, NULL, NULL, NULL, NULL),
(23, 49, NULL, NULL, NULL, NULL),
(46, 8, NULL, NULL, NULL, NULL),
(47, 9, NULL, NULL, NULL, NULL),
(48, 10, NULL, NULL, NULL, NULL),
(49, 11, NULL, NULL, NULL, NULL),
(50, 13, NULL, NULL, NULL, NULL),
(51, 5, NULL, NULL, NULL, NULL),
(53, 16, NULL, NULL, NULL, NULL),
(54, 17, NULL, NULL, NULL, NULL),
(55, 18, NULL, NULL, NULL, NULL),
(56, 3, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flash_sell`
--

CREATE TABLE `flash_sell` (
  `id` int(10) UNSIGNED NOT NULL,
  `flashPrice` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flashDate` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flashProduct` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `header_block`
--

CREATE TABLE `header_block` (
  `id` int(11) UNSIGNED NOT NULL,
  `articleName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstHomeTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondHomeTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstInnerTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondInnerTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstHomeImage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstInnerImage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homeDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `innerDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urlLink` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `articleIcon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `articleStatus` int(11) NOT NULL DEFAULT 1,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `header_block`
--

INSERT INTO `header_block` (`id`, `articleName`, `firstHomeTitle`, `secondHomeTitle`, `firstInnerTitle`, `secondInnerTitle`, `firstHomeImage`, `firstInnerImage`, `homeDescription`, `innerDescription`, `urlLink`, `articleIcon`, `metaTitle`, `metaKeyword`, `metaDescription`, `orderBy`, `articleStatus`, `section`, `created_at`, `updated_at`) VALUES
(3, 'Upcoming Events', NULL, NULL, NULL, NULL, NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'event', '2019-11-30 06:07:39', '2019-11-30 06:07:57'),
(4, 'Recent News', NULL, NULL, NULL, NULL, NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'activities', '2019-12-01 02:08:23', '2019-12-01 23:12:18'),
(5, 'Our Gallery', NULL, NULL, NULL, NULL, NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'photoGallery', '2019-12-01 23:44:29', '2019-12-01 23:44:29'),
(6, 'Our Customers', 'Our Customers', NULL, 'Our Customers', NULL, NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>We provide wholesale,Retail and Online delivery across the world.We have many valuable customer in different countries.We alreday received many award for best quality and quick shipment from our customer.Our customer happiness is our first priority.</p>\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p style=\"margin: 0in 0in 0.0001pt; line-height: 18pt; background: white; text-align: center;\" align=\"center\">We provide wholesale,Retail and Online delivery across the world.We have many valuable customer in different countries.We alreday received many award for best quality and quick shipment from our customer.Our customer happiness is our first priority.</p>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'customers', '2020-01-16 04:57:05', '2020-01-29 14:01:06'),
(7, 'Our Team', 'Our Team', NULL, NULL, NULL, NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Our Team Member</p>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'team', '2020-01-16 06:04:24', '2020-01-16 06:04:24'),
(8, 'Blog', 'Blog List', 'Blog List', 'Blog List', 'Blog List', NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'blog', '2020-01-21 04:27:41', '2020-01-21 04:27:41'),
(9, 'SEND A MESSAGE', '24/7 CUSTOMER SERVICES', 'VISIT HEAD OFFICE', '24/7 Free HelpLine', 'We usually reply within 24 hours', NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Fell free to Contract with us.We are available in Phone,Email,Whatsapp,Viber.</p>\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Fell free to Contract with us.We are available in Phone,Email,Whatsapp,Viber.</p>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'contacts', '2020-01-29 03:58:15', '2020-01-29 04:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `help_centers`
--

CREATE TABLE `help_centers` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoiceId` int(11) NOT NULL,
  `orderId` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productCode` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `productName` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `productQuantity` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `productPrice` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `productAmount` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `delivery_zone_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoiceId`, `orderId`, `productCode`, `productName`, `productQuantity`, `productPrice`, `productAmount`, `delivery_zone_id`, `delivery_zone_name`, `created_at`, `updated_at`) VALUES
(2, 11, '22', 'gym101', '1 Pair 5 colors Leg Warmers Basketball Calf Compression Sleeves Fitness Gym Calf Leg Running Compression Sleeve Socks', '1', '1000', '1000', NULL, NULL, '2020-02-26 06:07:28', '2020-02-26 06:07:28'),
(4, 2, '1', 'shoe101', 'Walking Shoes', '1', '1650', '1650', 2, 'Badda', '2020-03-11 04:57:31', '2020-03-11 04:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) UNSIGNED NOT NULL,
  `root_menu` int(11) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `menuName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `articleName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parentArticle` int(11) DEFAULT NULL,
  `firstHomeTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstHomeImage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homeDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urlLink` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menuIcon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `menuStatus` int(11) NOT NULL DEFAULT 1,
  `showInMenu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `showInFooterMenu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `root_menu`, `parent`, `menuName`, `articleName`, `parentArticle`, `firstHomeTitle`, `firstHomeImage`, `homeDescription`, `urlLink`, `menuIcon`, `metaTitle`, `metaKeyword`, `metaDescription`, `orderBy`, `menuStatus`, `showInMenu`, `showInFooterMenu`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'About Us', NULL, NULL, NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 1, 1, 'no', 'yes', '2020-02-26 22:56:54', '2020-02-26 23:22:18'),
(2, NULL, NULL, 'Frequently Asked Questions', NULL, NULL, NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 2, 1, 'no', 'yes', '2020-02-26 22:57:28', '2020-02-26 23:22:38'),
(3, NULL, NULL, 'Terms and Conditions', NULL, NULL, NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 3, 1, 'no', 'yes', '2020-02-26 22:58:04', '2020-02-26 23:22:48'),
(4, NULL, NULL, 'Privacy Policy', NULL, NULL, NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 4, 1, 'no', 'yes', '2020-02-26 22:58:34', '2020-02-26 23:22:57'),
(5, NULL, NULL, 'Shipping and Delivery', NULL, NULL, NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 5, 1, 'no', 'yes', '2020-02-26 22:59:31', '2020-02-26 23:23:06'),
(6, NULL, NULL, 'Customer Care', NULL, NULL, NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 6, 1, 'no', 'yes', '2020-02-26 22:59:55', '2020-02-26 23:23:16'),
(7, NULL, NULL, 'Careers', NULL, NULL, NULL, NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 7, 1, 'no', 'yes', '2020-02-26 23:00:21', '2020-02-26 23:23:26'),
(8, NULL, NULL, 'Order History', 'Order History', NULL, 'Order History', NULL, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 8, 1, 'no', 'yes', '2020-03-07 04:04:36', '2020-03-07 04:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_07_02_180455_create_categories_table', 1),
(4, '2018_07_13_130624_create_sub_categories_table', 1),
(5, '2018_07_14_141212_create_products_table', 1),
(6, '2018_07_18_172951_create_customers_table', 1),
(7, '2018_07_18_173018_create_shippings_table', 1),
(8, '2018_07_18_173045_create_checkouts_table', 1),
(9, '2018_07_18_173051_create_orders_table', 1),
(10, '2018_07_18_173115_create_transactions_table', 1),
(11, '2018_07_21_144649_create_contactuses_table', 1),
(12, '2018_07_22_211328_create_admins_table', 1),
(13, '2018_07_27_082321_create_careers_table', 1),
(14, '2018_07_27_103118_create_teams_table', 1),
(15, '2018_07_27_111833_create_sliders_table', 1),
(16, '2019_01_06_085032_create_packages_table', 1),
(17, '2019_03_13_120816_create_menus_table', 2),
(18, '2019_03_13_121439_create_menus_table', 3),
(19, '2018_11_17_160100_create_verifies_customers_table', 4),
(20, '2018_11_17_160100_create_verify_customers_table', 5),
(21, '2019_03_19_065715_create_settings_table', 6),
(22, '2018_07_02_180455_create_policies_table', 7),
(23, '2018_07_02_180455_create_banners_table', 8),
(24, '2019_03_27_075039_create_product_sections_table', 9),
(25, '2019_03_28_062230_create_product_sections_table', 10),
(26, '2019_03_30_094825_create_socials_table', 11),
(27, '2019_03_30_181906_create_product_sections_table', 12),
(28, '2019_04_03_083641_create_contacts_table', 13),
(29, '2019_04_03_104734_create_reviews_table', 14),
(30, '2019_04_03_105403_create_reviews_table', 15),
(31, '2019_04_04_111431_create_abouts_table', 16),
(32, '2019_04_04_112139_create_abouts_table', 17),
(33, '2019_04_07_042104_create_product_images_table', 18),
(34, '2019_04_05_060258_create_faqs_table', 19),
(35, '2019_04_09_072500_create_delivery_policies_table', 20),
(36, '2019_04_09_075441_create_payment_policies_table', 21),
(37, '2019_04_09_090821_create_refund_policies_table', 22),
(38, '2019_04_10_061020_create_help_centers_table', 22),
(39, '2019_04_10_071450_create_terms_table', 23),
(40, '2019_04_10_073726_create_blogs_table', 24),
(41, '2019_04_10_101945_create_newsletters_table', 25),
(42, '2019_04_17_062734_create_user_roles_table', 26),
(43, '2019_06_15_064819_create_shipping_charges_table', 27),
(44, '2019_06_16_100518_create_invoice_table', 28),
(45, '2019_07_14_074721_create_customer_group_section_table', 29),
(46, '2019_07_14_075751_create_customer_group_sections_table', 30),
(47, '2019_08_31_064148_create_vendors_table', 31),
(48, '2019_09_03_065923_create_cash_purchase_table', 32),
(49, '2019_09_03_070746_create_cash_purchase_item_table', 33),
(50, '2019_09_04_060034_create_credit_purchases_table', 34),
(51, '2019_09_04_060941_create_credit_purchase_items_table', 34),
(52, '2019_09_04_100454_create_purchase_order_items_table', 35),
(53, '2019_09_04_100609_create_purchase_orders_table', 35),
(54, '2019_09_05_053849_create_purchase_order_receives_table', 36),
(55, '2019_09_05_054156_create_purchase_order_receive_items_table', 36),
(56, '2019_09_05_095924_create_supplier_payments_table', 37),
(70, '2019_09_07_070859_create_purchase_returns_table', 38),
(71, '2019_09_07_071132_create_purchase_return_items_table', 38),
(72, '2019_10_14_054237_create_cash_sales_table', 39),
(73, '2019_10_14_061711_create_cash_sale_items_table', 40),
(74, '2019_10_14_081848_add_columns_to_cash_sale_items_table', 41),
(75, '2019_10_14_082532_add_vat_to_cash_sales_table', 42),
(76, '2019_10_14_103256_add_discount_as_to_cash_sales_table', 43),
(77, '2019_10_14_115714_create_credit_sales_table', 44),
(78, '2019_10_14_120911_create_credit_sale_items_table', 44),
(79, '2019_10_15_073308_create_client_entries_table', 45),
(80, '2019_10_15_121834_drop_columns_to_credit_sales_table', 46),
(81, '2019_10_16_100931_create_credit_collections_table', 47);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(10) UNSIGNED NOT NULL,
  `subscribeEmail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `delivery_zone_name` varchar(255) DEFAULT NULL,
  `shipping_location_id` int(11) DEFAULT NULL,
  `shipping_location_name` varchar(255) DEFAULT NULL,
  `shipping_charge` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Waiting',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `first_name`, `last_name`, `name`, `phone`, `email`, `shipping_address`, `delivery_zone_id`, `delivery_zone_name`, `shipping_location_id`, `shipping_location_name`, `shipping_charge`, `payment_method`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, NULL, 'Jisan Ahmed', '01834838457', 'jisanahmed06@gmail.com', 'DIT Project, Merul Badda', 2, 'Badda', NULL, NULL, NULL, NULL, '2136.00', 'Waiting', '2020-03-11 04:29:26', '2020-03-11 04:38:37'),
(3, 2, NULL, NULL, 'Mahedy Hasan', '018676886', 'mahedy@gmail.com', 'Uttara', 1, 'Uttara', NULL, NULL, NULL, NULL, '3200.00', 'Waiting', '2020-03-11 04:31:40', '2020-03-11 04:31:40'),
(4, 1, NULL, NULL, 'Techno Park', '232435436456', 'jisanahmed06@gmail.com', 'Road:9', 1, 'Uttara', NULL, NULL, NULL, NULL, '150.00', 'Waiting', '2020-05-01 18:50:37', '2020-05-01 18:50:37'),
(5, 1, NULL, NULL, 'Techno Park', '232435436456', 'jisanahmed06@gmail.com', 'Road:9', 1, 'Uttara', NULL, NULL, NULL, NULL, '4700.00', 'Waiting', '2020-05-01 18:51:48', '2020-05-01 18:51:48'),
(6, 3, NULL, NULL, 'Hhd', '0179849317', 'khan@gmail.com', 'Hdjjdjd', 1, 'Uttara', NULL, NULL, NULL, NULL, '2400.00', 'Waiting', '2020-09-07 06:59:07', '2020-09-07 06:59:07'),
(7, 4, NULL, NULL, 'creative software', '01318712782', 'ghoshsampa21@gmail.com', 'Mirpur -13,Road-4 Dhaka', 1, 'Uttara', NULL, NULL, NULL, NULL, '2150.00', 'Waiting', '2020-09-13 05:46:28', '2020-09-13 05:46:28'),
(8, 7, NULL, NULL, 'Md. Rafael Hossen', '01682960040', 'step2omi@gmail.com', '53/Cha, Kalaghata Road, Bandarban Sadar-4000, Bandarban, Chittagong', 3, 'Mirpur', NULL, NULL, NULL, NULL, '300.00', 'Waiting', '2020-09-16 08:05:38', '2020-09-16 08:05:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `delivery_zone_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `order_id`, `customer_id`, `product_id`, `name`, `code`, `qty`, `price`, `total`, `delivery_zone_id`, `delivery_zone_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 5, 'Walking Shoes', 'shoe101', '1', '1650', '1650', 2, 'Badda', '', '2020-03-11 04:29:26', '2020-03-11 04:29:26'),
(2, 2, 1, 9, 'Al Haramain Badar Concentrated Pure Perfume 15 ml (For Men)', 'per133', '1', '486', '486', 2, 'Badda', '', '2020-03-11 04:29:26', '2020-03-11 04:29:26'),
(3, 3, 2, 17, 'Baseus Wireless Charging Pad', 'WXFD-01', '1', '1200', '1200', 1, 'Uttara', '', '2020-03-11 04:31:40', '2020-03-11 04:31:40'),
(4, 3, 2, 18, 'Baseus Encok Wireless Bluetooth Earphone', 'S16', '1', '2000', '2000', 1, 'Uttara', '', '2020-03-11 04:31:40', '2020-03-11 04:31:40'),
(5, 4, 1, 3, 'Adapter', 'adapter101', '1', '150', '150', 1, 'Uttara', '', '2020-05-01 18:50:37', '2020-05-01 18:50:37'),
(6, 5, 1, 17, 'Baseus Wireless Charging Pad', 'WXFD-01', '1', '1200', '1200', 1, 'Uttara', '', '2020-05-01 18:51:48', '2020-05-01 18:51:48'),
(7, 5, 1, 2, 'Water Jug 2', 'wtj102', '1', '3500', '3500', 1, 'Uttara', '', '2020-05-01 18:51:48', '2020-05-01 18:51:48'),
(8, 6, 3, 17, 'Baseus Wireless Charging Pad', 'WXFD-01', '2', '1200', '2400', 1, 'Uttara', '', '2020-09-07 06:59:07', '2020-09-07 06:59:07'),
(9, 7, 4, 3, 'Adapter', 'adapter101', '1', '150', '150', 1, 'Uttara', '', '2020-09-13 05:46:28', '2020-09-13 05:46:28'),
(10, 7, 4, 18, 'Baseus Encok Wireless Bluetooth Earphone', 'S16', '1', '2000', '2000', 1, 'Uttara', '', '2020-09-13 05:46:28', '2020-09-13 05:46:28'),
(11, 8, 7, 16, 'Year Phone 1', 'yearphone121', '1', '300', '300', 3, 'Mirpur', '', '2020-09-16 08:05:38', '2020-09-16 08:05:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policiesStatus` tinyint(1) NOT NULL,
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `policies`
--

INSERT INTO `policies` (`id`, `title`, `description`, `image`, `icon`, `policiesStatus`, `metaTitle`, `metaKeyword`, `metaDescription`, `orderBy`, `created_at`, `updated_at`) VALUES
(8, 'Cash On Delivery', NULL, 'images/policies/cod_12815410431.jpg', NULL, 1, NULL, NULL, NULL, 1, '2020-02-27 01:36:14', '2020-02-27 01:36:14'),
(9, 'Mobile Payment', NULL, 'images/policies/mobile_payment_14158485850.jpg', NULL, 1, NULL, NULL, NULL, 2, '2020-02-27 01:37:42', '2020-02-27 01:37:42'),
(10, 'Swipe on Delivery', NULL, 'images/policies/online_payment_76195692033.jpg', NULL, 1, NULL, NULL, NULL, 3, '2020-02-27 01:37:57', '2020-02-27 01:37:57'),
(11, 'Online Payment', NULL, 'images/policies/online_payment_70745140252.jpg', NULL, 1, NULL, NULL, NULL, 4, '2020-02-27 01:38:15', '2020-02-27 01:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `root_category` int(10) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `reorder_qty` int(10) UNSIGNED NOT NULL DEFAULT 5,
  `stockUnit` int(11) DEFAULT NULL,
  `weight` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) NOT NULL,
  `discount` double(8,2) DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `youtubeLink` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productSection` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `root_category`, `name`, `description1`, `description2`, `deal_code`, `phone_no`, `qty`, `reorder_qty`, `stockUnit`, `weight`, `price`, `discount`, `status`, `youtubeLink`, `productSection`, `tag`, `metaTitle`, `metaKeyword`, `metaDescription`, `orderBy`, `created_at`, `updated_at`) VALUES
(1, '9,17', NULL, 'Water Jug', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'wtj101', NULL, NULL, 5, NULL, NULL, 3600, 3000.00, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-02-23 01:09:56', '2020-02-24 05:20:29'),
(2, '9,17', NULL, 'Water Jug 2', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'wtj102', NULL, NULL, 5, NULL, NULL, 3500, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2020-02-23 01:12:19', '2020-02-24 05:19:51'),
(3, '9,17', NULL, 'Adapter', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'adapter101', NULL, NULL, 5, NULL, NULL, 150, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 3, '2020-02-23 01:13:25', '2020-02-24 06:02:35'),
(4, '9,17', NULL, 'IC Pin', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'ic101', NULL, NULL, 5, NULL, NULL, 390, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 4, '2020-02-23 01:14:08', '2020-02-24 05:21:39'),
(5, '14', 14, 'Walking Shoes', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'shoe101', NULL, NULL, 5, NULL, NULL, 1650, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 5, '2020-02-23 01:15:43', '2020-02-23 05:28:48'),
(6, '14', 14, 'Comfortable Shoes', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'shoe102', NULL, NULL, 5, NULL, NULL, 200, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 6, '2020-02-23 01:16:50', '2020-02-23 01:16:50'),
(7, '9', 9, 'Black Berth-able', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'glaps101', NULL, NULL, 5, NULL, NULL, 2000, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 7, '2020-02-23 01:18:28', '2020-02-23 05:19:02'),
(8, '14', NULL, '1 Pair 5 colors Leg Warmers Basketball Calf Compression Sleeves Fitness Gym Calf Leg Running Compression Sleeve Socks', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'gym101', NULL, NULL, 5, NULL, NULL, 1000, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 3, '2020-02-24 22:23:59', '2020-02-24 22:23:59'),
(9, '14', NULL, 'Al Haramain Badar Concentrated Pure Perfume 15 ml (For Men)', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'per133', NULL, NULL, 5, NULL, NULL, 486, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 4, '2020-02-24 22:25:32', '2020-02-24 22:25:32'),
(10, '14', NULL, 'Al-Nuaim World Black 6ml Attar Roll On (Exclusive Series)                                     }', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'roll015', NULL, NULL, 5, NULL, NULL, 250, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 7, '2020-02-24 22:34:30', '2020-02-24 22:34:30'),
(11, '14', NULL, 'AUTO BIOGRAPHY - EAU DE PERFUME - PARIS CORNER', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'per345', NULL, NULL, 5, NULL, NULL, 2500, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 6, '2020-02-24 22:45:33', '2020-02-24 22:45:33'),
(12, '14', NULL, 'Be Eau De Toilette for Men - 100ml', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'oil1333', NULL, NULL, 5, NULL, NULL, 2500, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 8, '2020-02-24 22:46:35', '2020-02-24 22:46:35'),
(13, '14', NULL, 'BROWN ORCHID FOR MEN - 80 ML', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'orc901', NULL, NULL, 5, NULL, NULL, 1700, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2020-02-24 22:47:56', '2020-02-24 22:47:56'),
(14, '14', NULL, 'Calvin Klein Encounter Fresh EDT For Men -100ml', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'per150', NULL, NULL, 5, NULL, NULL, 5000, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 10, '2020-02-24 22:49:11', '2020-02-24 22:49:11'),
(16, '9', NULL, 'Year Phone 1', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'yearphone121', NULL, NULL, 5, NULL, NULL, 300, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-03-01 09:23:32', '2020-03-01 09:23:32'),
(17, '9', NULL, 'Baseus Wireless Charging Pad', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'WXFD-01', NULL, NULL, 5, NULL, NULL, 1200, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2020-03-01 09:47:02', '2020-03-01 09:47:02'),
(18, '9', NULL, 'Baseus Encok Wireless Bluetooth Earphone', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'S16', NULL, NULL, 5, NULL, NULL, 2050, 2000.00, 1, NULL, NULL, NULL, NULL, NULL, NULL, 3, '2020-03-01 09:48:44', '2020-03-01 09:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `productId` int(11) NOT NULL,
  `originalImageId` int(11) DEFAULT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `productId`, `originalImageId`, `section`, `images`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'original', 'images/products/Water Jug/5e1c41cb98456_126459469034.jpg', '2020-02-23 01:10:08', '2020-02-23 01:10:08'),
(2, 1, 1, 'content', 'images/products/Water Jug//content_image/5e1c41cb98456_89989514561.jpg', '2020-02-23 01:10:08', '2020-02-23 01:10:08'),
(3, 2, NULL, 'original', 'images/products/Water Jug 2/5e1c42aca5b3e_72321340018.jpg', '2020-02-23 01:12:30', '2020-02-23 01:12:30'),
(4, 2, 3, 'content', 'images/products/Water Jug 2//content_image/5e1c42aca5b3e_40703232440.jpg', '2020-02-23 01:12:30', '2020-02-23 01:12:30'),
(5, 3, NULL, 'original', 'images/products/Adapter/5e48d7e580dc9_22027403873.png', '2020-02-23 01:13:33', '2020-02-23 01:13:33'),
(6, 3, 5, 'content', 'images/products/Adapter//content_image/5e48d7e580dc9_72319378856.png', '2020-02-23 01:13:33', '2020-02-23 01:13:33'),
(7, 4, NULL, 'original', 'images/products/IC Pin/5e48dcde9a175_86455138902.png', '2020-02-23 01:14:16', '2020-02-23 01:14:16'),
(8, 4, 7, 'content', 'images/products/IC Pin//content_image/5e48dcde9a175_59398228079.png', '2020-02-23 01:14:16', '2020-02-23 01:14:16'),
(9, 5, NULL, 'original', 'images/products/Walking Shoes/5e1c2aca02f7e_58970399211.jpg', '2020-02-23 01:15:50', '2020-02-23 01:15:50'),
(10, 5, 9, 'content', 'images/products/Walking Shoes//content_image/5e1c2aca02f7e_66916953216.jpg', '2020-02-23 01:15:50', '2020-02-23 01:15:50'),
(11, 6, NULL, 'original', 'images/products/Comfortable Shoes/5e1c29d26d9b6_84019792305.jpg', '2020-02-23 01:16:58', '2020-02-23 01:16:58'),
(12, 6, 11, 'content', 'images/products/Comfortable Shoes//content_image/5e1c29d26d9b6_97266901239.jpg', '2020-02-23 01:16:58', '2020-02-23 01:16:58'),
(13, 7, NULL, 'original', 'images/products/Black Berth-able/5e1c3ec9c0456_51733911533.jpg', '2020-02-23 01:18:36', '2020-02-23 01:18:36'),
(14, 7, 13, 'content', 'images/products/Black Berth-able//content_image/5e1c3ec9c0456_76491244782.jpg', '2020-02-23 01:18:36', '2020-02-23 01:18:36'),
(15, 8, NULL, 'original', 'images/products/1 Pair 5 colors Leg Warmers Basketball Calf Compression Sleeves Fitness Gym Calf Leg Running Compression Sleeve Socks/5e1da8cccc41f_8370826625.jpg', '2020-02-24 22:24:46', '2020-02-24 22:24:46'),
(16, 8, 15, 'content', 'images/products/1 Pair 5 colors Leg Warmers Basketball Calf Compression Sleeves Fitness Gym Calf Leg Running Compression Sleeve Socks//content_image/5e1da8cccc41f_4835320273.jpg', '2020-02-24 22:24:47', '2020-02-24 22:24:47'),
(17, 9, NULL, 'original', 'images/products/Al Haramain Badar Concentrated Pure Perfume 15 ml (For Men)/5e539971125c9_77630675908.png', '2020-02-24 22:25:53', '2020-02-24 22:25:53'),
(18, 9, 17, 'content', 'images/products/Al Haramain Badar Concentrated Pure Perfume 15 ml (For Men)//content_image/5e539971125c9_20896691931.png', '2020-02-24 22:25:53', '2020-02-24 22:25:53'),
(19, 10, NULL, 'original', 'images/products/Al-Nuaim World Black 6ml Attar Roll On (Exclusive Series)                                     }/5e539cec9c197_70464557576.png', '2020-02-24 22:34:52', '2020-02-24 22:34:52'),
(20, 10, 19, 'content', 'images/products/Al-Nuaim World Black 6ml Attar Roll On (Exclusive Series)                                     }//content_image/5e539cec9c197_9717361295.png', '2020-02-24 22:34:53', '2020-02-24 22:34:53'),
(21, 11, NULL, 'original', 'images/products/AUTO BIOGRAPHY - EAU DE PERFUME - PARIS CORNER/5e539943f326a_44726205625.png', '2020-02-24 22:45:59', '2020-02-24 22:45:59'),
(22, 11, 21, 'content', 'images/products/AUTO BIOGRAPHY - EAU DE PERFUME - PARIS CORNER//content_image/5e539943f326a_49132720727.png', '2020-02-24 22:45:59', '2020-02-24 22:45:59'),
(23, 12, NULL, 'original', 'images/products/Be Eau De Toilette for Men - 100ml/5e53954493cef_12906175708.png', '2020-02-24 22:47:08', '2020-02-24 22:47:08'),
(24, 12, 23, 'content', 'images/products/Be Eau De Toilette for Men - 100ml//content_image/5e53954493cef_94643507712.png', '2020-02-24 22:47:08', '2020-02-24 22:47:08'),
(25, 13, NULL, 'original', 'images/products/BROWN ORCHID FOR MEN - 80 ML/5e539b4c953cd_59870243820.png', '2020-02-24 22:48:16', '2020-02-24 22:48:16'),
(26, 13, 25, 'content', 'images/products/BROWN ORCHID FOR MEN - 80 ML//content_image/5e539b4c953cd_53726251759.png', '2020-02-24 22:48:16', '2020-02-24 22:48:16'),
(27, 14, NULL, 'original', 'images/products/Calvin Klein Encounter Fresh EDT For Men -100ml/5e5396866ace0_10484711528.png', '2020-02-24 22:49:33', '2020-02-24 22:49:33'),
(53, 17, NULL, 'original', 'images/products/Baseus Wireless Charging Pad/5c062a660ef4d_21487373632.jpg', '2020-03-01 09:47:17', '2020-03-01 09:47:17'),
(54, 17, 53, 'content', 'images/products/Baseus Wireless Charging Pad/content_image/5c062a660ef4d_98713507268.jpg', '2020-03-01 09:47:17', '2020-03-01 09:47:17'),
(55, 17, 53, 'top_gadget', 'images/products/Baseus Wireless Charging Pad/top_gadget_image/5c062a660ef4d_26765330598.jpg', '2020-03-01 09:47:17', '2020-03-01 09:47:17'),
(56, 18, NULL, 'original', 'images/products/Baseus Encok Wireless Bluetooth Earphone/5c31a06fac378_94350873346.png', '2020-03-01 09:49:02', '2020-03-01 09:49:02'),
(57, 18, 56, 'content', 'images/products/Baseus Encok Wireless Bluetooth Earphone/content_image/5c31a06fac378_54575376588.png', '2020-03-01 09:49:02', '2020-03-01 09:49:02'),
(58, 18, 56, 'top_gadget', 'images/products/Baseus Encok Wireless Bluetooth Earphone/top_gadget_image/5c31a06fac378_14943286740.png', '2020-03-01 09:49:03', '2020-03-01 09:49:03'),
(71, 16, NULL, 'original', 'images/products/Year Phone 1/top-gadgets-banner_17702047535.jpg', '2020-03-07 01:16:08', '2020-03-07 01:16:08'),
(72, 16, 71, 'content', 'images/products/Year Phone 1/content_image/top-gadgets-banner_65551788636.jpg', '2020-03-07 01:16:08', '2020-03-07 01:16:08'),
(73, 16, 71, 'top_gadget', 'images/products/Year Phone 1/top_gadget_image/top-gadgets-banner_90427113497.jpg', '2020-03-07 01:16:08', '2020-03-07 01:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `product_sections`
--

CREATE TABLE `product_sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `productId` int(11) NOT NULL,
  `productSection` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotDiscount` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotDate` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialDiscount` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialDate` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `free_shipping` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pre_order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pre_orderDuration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_product` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sections`
--

INSERT INTO `product_sections` (`id`, `productId`, `productSection`, `hotDiscount`, `hotDate`, `specialDiscount`, `specialDate`, `free_shipping`, `pre_order`, `pre_orderDuration`, `related_product`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-23 01:09:56', '2020-02-23 01:09:56'),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-23 01:12:19', '2020-02-23 01:12:19'),
(3, 3, '2', '', '', '', '', NULL, NULL, NULL, NULL, '2020-02-23 01:13:25', '2020-03-08 14:06:11'),
(4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-23 01:14:08', '2020-02-23 01:14:08'),
(5, 5, '2', '', '', '', '', NULL, NULL, NULL, NULL, '2020-02-23 01:15:43', '2020-02-25 05:34:33'),
(6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-23 01:16:50', '2020-02-23 01:16:50'),
(7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-23 01:18:28', '2020-02-23 01:18:28'),
(8, 8, '1', '', '', '', '', NULL, NULL, NULL, NULL, '2020-02-24 22:24:00', '2020-02-25 05:16:37'),
(9, 9, '1', '', '', '', '', NULL, NULL, NULL, '8,10,13,14,6,5', '2020-02-24 22:25:32', '2020-02-25 05:16:49'),
(10, 10, '1', '', '', '', '', NULL, NULL, NULL, NULL, '2020-02-24 22:34:30', '2020-02-25 05:17:04'),
(11, 11, '2', '', '', '', '', NULL, NULL, NULL, NULL, '2020-02-24 22:45:33', '2020-02-25 05:30:59'),
(12, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-24 22:46:35', '2020-02-24 22:46:35'),
(13, 13, '2', '', '', '', '', NULL, NULL, NULL, NULL, '2020-02-24 22:47:56', '2020-02-25 05:31:25'),
(14, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-24 22:49:11', '2020-02-24 22:49:11'),
(16, 16, '2', '', '', '', '', NULL, NULL, NULL, NULL, '2020-03-01 09:23:32', '2020-03-01 09:25:05'),
(17, 17, '2', '', '', '', '', NULL, NULL, NULL, NULL, '2020-03-01 09:47:02', '2020-03-01 09:47:09'),
(18, 18, '2', '', '', '', '', NULL, NULL, NULL, NULL, '2020-03-01 09:48:44', '2020-03-01 09:48:53');

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_wise_profit`
-- (See below for the actual view)
--
CREATE TABLE `product_wise_profit` (
`date` datetime
,`productId` int(10) unsigned
,`categoryId` mediumtext
,`cashProductQty` varchar(191)
,`cashPriceAmount` varchar(191)
,`cashVatAmount` double
,`cashDiscountAmount` double
,`creditProductQty` varchar(255)
,`creditPriceAmount` varchar(255)
,`creditVatAmount` double
,`creditDiscountAmount` double
,`delivery_zone_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'purchase_order',
  `supplier_id` int(11) NOT NULL,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` datetime NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `voucher_date` datetime DEFAULT NULL,
  `total_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `type`, `supplier_id`, `order_no`, `delivery_date`, `order_date`, `voucher_date`, `total_qty`, `total_amount`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(2, 'purchase_order', 1, '1000002', '2020-03-12 00:00:00', '2020-03-12 00:00:00', NULL, '30.00', '112000.00', 2, '2020-03-11 23:11:35', '2020-03-11 23:11:35');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_items`
--

INSERT INTO `purchase_order_items` (`id`, `purchase_order_id`, `product_id`, `qty`, `rate`, `amount`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(1, 1, 58, '10', '200', '2000.00', NULL, NULL, NULL),
(2, 1, 46, '7', '400', '2800.00', NULL, NULL, NULL),
(3, 2, 6, '20', '5500', '110000.00', 2, '2020-03-11 23:11:35', '2020-03-11 23:11:35'),
(4, 2, 4, '10', '200', '2000.00', 2, '2020-03-11 23:11:35', '2020-03-11 23:11:35');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_receives`
--

CREATE TABLE `purchase_order_receives` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchaseOrderNo` int(11) NOT NULL,
  `receive_date` datetime NOT NULL,
  `total_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_receives`
--

INSERT INTO `purchase_order_receives` (`id`, `purchaseOrderNo`, `receive_date`, `total_qty`, `total_amount`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(2, 2, '2020-03-12 00:00:00', '30.00', '28500.00', 2, '2020-03-12 00:08:45', '2020-03-12 00:08:45'),
(3, 2, '2020-03-12 00:00:00', '30.00', '28100.00', 2, '2020-03-12 00:09:10', '2020-03-12 00:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_receive_items`
--

CREATE TABLE `purchase_order_receive_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_order_receive_id` int(11) NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_receive_items`
--

INSERT INTO `purchase_order_receive_items` (`id`, `purchase_order_receive_id`, `product_id`, `product_name`, `qty`, `rate`, `amount`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(3, 2, '6', 'Comfortable Shoes', '5', '5500', '27500.00', 2, '2020-03-12 00:08:45', '2020-03-12 00:08:45'),
(4, 2, '4', 'IC Pin', '5', '200', '1000.00', 2, '2020-03-12 00:08:45', '2020-03-12 00:08:45'),
(5, 3, '6', 'Comfortable Shoes', '5', '5500', '27500.00', 2, '2020-03-12 00:09:10', '2020-03-12 00:09:10'),
(6, 3, '4', 'IC Pin', '3', '200', '600.00', 2, '2020-03-12 00:09:10', '2020-03-12 00:09:10');

-- --------------------------------------------------------

--
-- Stand-in structure for view `purchase_order_status`
-- (See below for the actual view)
--
CREATE TABLE `purchase_order_status` (
`supplierId` int(11)
,`orderNo` varchar(255)
,`date` datetime
,`productId` varchar(255)
,`delivery_zone_id` int(11)
,`orderQty` varchar(255)
,`receiveQty` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_returns`
--

CREATE TABLE `purchase_returns` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_return_serial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_return_date` datetime NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_returns`
--

INSERT INTO `purchase_returns` (`id`, `purchase_return_serial`, `purchase_return_date`, `supplier_id`, `remarks`, `total_qty`, `total_amount`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(1, '1000001', '2020-03-12 00:00:00', 1, NULL, '1', '0', 2, '2020-03-12 00:15:26', '2020-03-12 00:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_items`
--

CREATE TABLE `purchase_return_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_return_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_return_items`
--

INSERT INTO `purchase_return_items` (`id`, `purchase_return_id`, `product_id`, `qty`, `rate`, `amount`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '5', '200', '0', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `star` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `sales_collection_standings`
-- (See below for the actual view)
--
CREATE TABLE `sales_collection_standings` (
`customerId` varchar(255)
,`type` varchar(255)
,`date` datetime
,`sales` varchar(255)
,`collection` int(11)
,`delivery_zone_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sales_contribution`
-- (See below for the actual view)
--
CREATE TABLE `sales_contribution` (
`categoryId` mediumtext
,`productId` varchar(255)
,`cashSaleQty` double
,`cashSaleAmount` double
,`creditSaleQty` double
,`creditSaleAmount` double
,`delivery_zone_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `siteTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titlePrefix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteLogo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sitefavIcon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adminTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adminLogo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adminsmalLogo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adminfavIcon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteEmail1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteEmail2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteAddress1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteAddress2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sitestatus` int(11) DEFAULT NULL,
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `siteTitle`, `siteName`, `titlePrefix`, `siteLogo`, `sitefavIcon`, `adminTitle`, `adminLogo`, `adminsmalLogo`, `adminfavIcon`, `mobile1`, `mobile2`, `siteEmail1`, `siteEmail2`, `siteAddress1`, `siteAddress2`, `sitestatus`, `metaTitle`, `metaKeyword`, `metaDescription`, `orderBy`, `created_at`, `updated_at`) VALUES
(1, 'Online Shopping Store', 'Best Import Store', '|', 'images/site_logo/logo/Untitled-2_57850399193.png', 'images/site_logo/fav_icon/fav_icon_81706791684.png', 'Admin', 'images/admin_logo/main_logo/admin_logo_38118410537.png', 'images/admin_logo/small_logo/fav_icon_85642158256.png', 'images/admin_logo/fav_icon/fav_icon_92365142475.png', '01778-311111', NULL, 'bis@gmail.com', NULL, 'La-Montana,Gareeb-E-Newaj Avenue', 'Sector:11,Uttara,Dhaka-1230,Bangladesh', NULL, 'root || Bangladeshi Handicrafts Products', 'Handicrafts, Handicraft in Bangladesh , Nakshi Kantha , Nokshi Kantha , Nokshi Katha Design , Online Shopping BD, Salwar Kameez Bangladesh  , Handmade Jewelry, Online Shopping Bangladesh, Hater Kaj', 'Handicrafts  Item In Bangladesh, We have Nakshi Home Decor,  Nakshi ladies dress, Nakshi Kantha, Handmade item, wall hanging. handmade jewelry many more!', 1, NULL, '2020-03-12 05:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` int(10) UNSIGNED NOT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `delivery_area_id` int(11) DEFAULT NULL,
  `shippingCharge` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `shippingStatus` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `delivery_zone_id`, `delivery_area_id`, `shippingCharge`, `orderBy`, `shippingStatus`, `created_at`, `updated_at`) VALUES
(2, 1, 7, '30', NULL, 1, '2020-03-04 00:37:30', '2020-03-04 00:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `section` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `image`, `productId`, `section`, `link`, `status`, `metaTitle`, `metaKeyword`, `metaDescription`, `orderBy`, `created_at`, `updated_at`) VALUES
(1, 'Rodela', 'images/sliders/51311722_2124739987572844_1293851824108863488_o_92054081163.jpg', NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, '2019-12-01 11:11:39', '2020-03-03 03:12:35'),
(4, 'Bag', 'images/sliders/61425385_2285974331449408_8592269409236549632_o_45342492151.jpg', NULL, NULL, 'https://kitesnebc.com/', 1, NULL, NULL, NULL, 1, '2019-12-01 12:01:47', '2020-03-03 04:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `name`, `icon`, `link`, `status`, `orderBy`, `created_at`, `updated_at`) VALUES
(3, 'Faccebook', '<i class=\"fa fa-facebook\"></i>', 'https://www.facebook.com', 1, 1, '2019-12-01 05:54:34', '2020-01-23 09:29:56'),
(4, 'Twiteer', '<i class=\"fa fa-twitter\"></i>', 'https://twitter.com', 1, 2, '2019-12-01 05:56:55', '2020-01-16 01:00:52'),
(5, 'whatsapp', '<i class=\"fa fa-whatsapp\"></i>', 'https://www.whatsapp.com/', 1, 4, '2020-01-11 04:12:44', '2020-01-16 01:00:18'),
(6, 'Linkdin', '<i class=\"fa fa-linkedin\"></i>', 'facebook.com', 0, 4, '2020-01-11 04:13:04', '2020-01-16 00:58:00'),
(7, 'Instagram', '<i class=\"fa fa-instagram\"></i>', 'https://www.instagram.com/', 1, 3, '2020-01-11 04:13:29', '2020-01-16 01:01:10');

-- --------------------------------------------------------

--
-- Stand-in structure for view `stock_status_report`
-- (See below for the actual view)
--
CREATE TABLE `stock_status_report` (
`supplierId` int(11)
,`date` datetime
,`categoryId` mediumtext
,`productId` varchar(255)
,`receiveQty` varchar(255)
,`receiveAmount` varchar(255)
,`cashSaleQty` varchar(191)
,`creditSaleQty` varchar(255)
,`delivery_zone_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `stock_valuation_report`
-- (See below for the actual view)
--
CREATE TABLE `stock_valuation_report` (
`supplierId` int(11)
,`categoryId` mediumtext
,`productId` int(11)
,`cashPurchaseQty` varchar(255)
,`cashPurchaseAmount` varchar(255)
,`creditPurchaseQty` varchar(255)
,`creditPurchaseAmount` varchar(255)
,`purchaseReturnQty` varchar(255)
,`purchaseReturnAmount` varchar(255)
,`cashSaleQty` varchar(191)
,`cashSaleAmount` varchar(191)
,`creditSaleQty` int(1)
,`creditSaleAmount` int(1)
,`salesReturnQty` int(1)
,`delivery_zone_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payments`
--

CREATE TABLE `supplier_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `payment_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` datetime NOT NULL,
  `current_due` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_now` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `money_receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_payments`
--

INSERT INTO `supplier_payments` (`id`, `supplier_id`, `payment_no`, `payment_date`, `current_due`, `payment_now`, `balance`, `money_receipt`, `payment_type`, `remarks`, `delivery_zone_id`, `created_at`, `updated_at`) VALUES
(1, 1, '1000001', '2020-03-12 00:00:00', '3900', '1000', '2900.00', '45654654654', 'Cash', 'fhgnghmhgmhmhjmjh', 2, '2020-03-11 23:36:58', '2020-03-11 23:36:58');

-- --------------------------------------------------------

--
-- Stand-in structure for view `supplier_statement_report`
-- (See below for the actual view)
--
CREATE TABLE `supplier_statement_report` (
`type` varchar(100)
,`date` datetime
,`lifting` double
,`payment` double
,`others` double
,`vendorId` int(11)
,`delivery_zone_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `supply_payment_summery`
-- (See below for the actual view)
--
CREATE TABLE `supply_payment_summery` (
`supplierId` int(11)
,`type` varchar(100)
,`date` datetime
,`purchase` varchar(255)
,`payment` varchar(255)
,`delivery_zone_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_menus`
--

CREATE TABLE `user_menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `parentMenu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menuName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menuLink` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `menuIcon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) NOT NULL,
  `menuStatus` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_menus`
--

INSERT INTO `user_menus` (`id`, `parentMenu`, `menuName`, `menuLink`, `menuIcon`, `orderBy`, `menuStatus`, `created_at`, `updated_at`) VALUES
(1, '13', 'Flash Sell', 'flashSell', 'fa fa-caret', 11, '1', '2019-11-26 23:51:55', '2019-11-26 23:51:55'),
(3, NULL, 'Dashboard', 'admin.index', 'fa fa-shopping-bag', 1, '1', '2019-08-30 04:08:49', '2019-08-31 01:52:17'),
(6, NULL, 'Business', 'admin.index', 'fa fa-bars', 4, '1', '2019-08-30 04:47:14', '2020-02-26 22:42:59'),
(7, '6', 'Pending Order', 'order.new', 'fa fa-caret-right', 3, '1', '2019-08-30 04:48:23', '2019-08-30 05:19:18'),
(8, '6', 'Processing', 'order.processing', 'fa fa-caret-right', 4, '1', '2019-08-30 04:49:49', '2019-08-30 05:19:42'),
(10, '6', 'Shipping', 'order.shipping', 'fa fa-caret-right', 5, '1', '2019-08-30 05:11:21', '2019-08-30 05:21:29'),
(11, '6', 'Complete', 'orderlist.complete', 'fa fa-caret-right', 6, '1', '2019-08-30 05:22:21', '2019-08-30 05:22:21'),
(12, NULL, 'Customers', 'customers.index', 'fa fa-bars', 7, '1', '2019-08-30 05:26:51', '2019-08-30 05:26:51'),
(13, NULL, 'Business Settings', 'admin.index', 'fa fa-bars', 5, '1', '2019-08-30 05:27:47', '2020-02-26 22:43:15'),
(14, '13', 'Products', 'products.index', 'fa fa-caret-right', 10, '1', '2019-08-30 05:28:28', '2019-08-30 05:36:20'),
(15, '13', 'Categories', 'categories.index', 'fa fa-caret-right', 9, '1', '2019-08-30 05:28:59', '2019-08-30 05:43:13'),
(16, '13', 'Shipping Charge', 'shippingCharges.index', 'fa fa-caret-right', 11, '1', '2019-08-30 05:29:45', '2019-09-03 05:34:58'),
(17, '13', 'Customer Group', 'customerGroups.index', 'fa fa-caret-right', 12, '1', '2019-08-30 05:34:10', '2019-08-30 05:34:10'),
(18, NULL, 'Portal Information', 'admin.index', 'fa fa-bars', 2, '1', '2019-08-30 05:47:44', '2019-10-30 09:37:07'),
(19, '18', 'Site Info', 'site.info', 'fa fa-caret-right', 14, '1', '2019-08-30 05:48:51', '2019-08-30 05:48:51'),
(20, '18', 'Menu', 'menu.index', 'fa fa-caret-right', 15, '1', '2019-08-30 05:49:27', '2020-02-26 22:41:17'),
(21, '18', 'Sliders', 'sliders.index', 'fa fa-caret-right', 16, '1', '2019-08-30 05:50:07', '2019-08-30 05:50:07'),
(22, '18', 'Advertizement', 'banners.index', 'fa fa-caret-right', 17, '1', '2019-08-30 05:51:17', '2019-08-30 05:51:17'),
(23, '18', 'Policies', 'policies.index', 'fa fa-caret-right', 18, '1', '2019-08-30 05:51:53', '2019-08-30 05:51:53'),
(24, '18', 'Social Link', 'social.index', 'fa fa-caret-right', 19, '1', '2019-08-30 05:52:26', '2020-03-01 10:37:28'),
(26, '18', 'Contact Us', 'contacts.index', 'fa fa-caret-right', 21, '0', '2019-08-30 05:53:19', '2020-03-03 04:53:45'),
(28, '18', 'Customer Review', 'reviews.index', 'fa fa-caret-right', 23, '0', '2019-08-30 05:55:02', '2020-03-03 04:53:35'),
(32, '18', 'Blog', 'blogs.index', 'fa fa-caret-right', 27, '0', '2019-08-30 05:57:09', '2020-03-03 04:54:33'),
(34, '18', 'Subscriber', 'subscribers.index', 'fa fa-caret-right', 29, '0', '2019-08-30 05:58:05', '2020-03-03 04:54:14'),
(36, NULL, 'User Management', 'admin.index', 'fa fa-bars', 10, '1', '2019-08-30 06:00:46', '2019-10-30 09:48:00'),
(37, '36', 'Admin Panel Logo', 'admin.logo', 'fa fa-caret-right', 1, '1', '2019-08-30 06:01:24', '2020-04-01 21:00:31'),
(38, '36', 'Menus', 'usermenu.index', 'fa fa-caret-right', 2, '1', '2019-08-30 06:01:52', '2020-04-01 21:00:49'),
(39, '36', 'Role', 'user-roles.index', 'fa fa-caret-right', 3, '1', '2019-08-30 06:02:12', '2020-04-01 21:01:03'),
(40, '36', 'User', 'users.index', 'fa fa-caret-right', 4, '1', '2019-08-30 06:02:35', '2020-04-01 21:01:18'),
(41, '13', 'Vendor Setup', 'vendor.index', 'fa fa-caret-right', 36, '1', '2019-08-30 23:56:33', '2019-10-24 12:47:51'),
(42, '43', 'Cash Purchase', 'cashPurchase.index', 'fa fa-caret-right', 37, '1', '2019-09-02 22:19:01', '2019-09-03 22:19:56'),
(43, NULL, 'Procurement', 'admin.index', 'fa fa-bars', 5, '1', '2019-09-03 22:16:44', '2019-10-30 09:43:58'),
(44, '43', 'Credit Purchase', 'creditPurchase.index', 'fa fa-caret', 38, '1', '2019-09-03 22:23:17', '2019-09-03 22:27:58'),
(45, '43', 'Purchase Order', 'purchaseOrder.index', 'fa fa-caret', 39, '1', '2019-09-04 03:33:52', '2019-09-04 03:33:52'),
(46, '43', 'PO Receive', 'purchaseOrderReceive.index', 'fa fa-caret', 40, '1', '2019-09-04 05:42:53', '2019-10-16 03:59:53'),
(47, '43', 'Supplier Payment', 'supplierPayment.index', 'fa fa-caret', 41, '1', '2019-09-05 02:43:41', '2019-09-05 02:43:41'),
(48, '43', 'Purchase Return', 'purchaseReturn.index', 'fa fa-caret', 42, '1', '2019-09-06 23:49:00', '2019-09-06 23:49:00'),
(49, NULL, 'Inventory Report', 'admin.index', 'fa fa-bars', 9, '1', '2019-09-07 22:41:33', '2019-10-30 09:47:36'),
(50, '49', 'Purchase Log', 'purchaseLog.index', 'fa fa-caret', 43, '0', '2019-09-07 22:46:41', '2020-03-11 06:27:21'),
(51, '62', 'Supplier Statement', 'supplierStatement.index', 'fa fa-caret', 44, '1', '2019-09-08 03:55:46', '2019-11-03 17:25:25'),
(52, NULL, 'Sales Management', 'admin.index', 'fa fa-bars', 7, '1', '2019-10-13 01:14:42', '2019-10-30 09:46:24'),
(53, '52', 'Cash Sale', 'cashSale.index', 'fa fa-caret', 46, '1', '2019-10-13 02:49:58', '2019-10-13 02:51:01'),
(54, '52', 'Credit Sale', 'creditSale.index', 'fa fa-caret', 47, '1', '2019-10-14 05:39:54', '2019-10-14 05:42:00'),
(55, '13', 'Client Entry', 'clientEntry.index', 'fa fa-bars', 48, '1', '2019-10-14 06:30:55', '2019-10-30 09:49:39'),
(56, '52', 'Credit Collection', 'creditCollection.index', 'fa fa-caret', 49, '1', '2019-10-15 23:47:51', '2019-10-15 23:47:51'),
(57, NULL, 'Sales Report', 'admin.index', 'fa fa-caret', 8, '1', '2019-10-16 23:50:29', '2019-10-30 09:46:58'),
(58, '57', 'Sales History', 'salesHistory.index', 'fa fa-caret', 51, '1', '2019-10-17 00:07:09', '2019-10-17 00:07:09'),
(59, '57', 'Product Wise Sales', 'productWiseSales.index', 'fa fa-caret', 52, '1', '2019-10-17 00:15:53', '2019-10-17 00:15:53'),
(60, '57', 'Client Wise Sales', 'clientWiseSales.index', 'fa fa-caret', 53, '1', '2019-10-17 00:20:05', '2019-10-17 00:20:05'),
(61, NULL, 'Basic Report', 'admin.index', 'fa fa-bars', 4, '1', '2019-10-30 09:43:26', '2019-10-30 09:43:26'),
(62, NULL, 'Procurement Report', 'admin.index', 'fa fa-bars', 6, '1', '2019-10-30 09:45:13', '2019-10-30 09:45:13'),
(63, '62', 'Purchase History', 'purchaseHistory.index', 'fa fa-caret', 1, '1', '2019-10-31 16:31:58', '2019-10-31 16:31:58'),
(64, '62', 'Purchase Return History', 'purchaseReturnHistory.index', 'fa fa-caret', 2, '1', '2019-11-02 10:26:38', '2019-11-02 10:26:38'),
(65, '62', 'Payment Log', 'paymentLog.index', 'fa fa-bars', 3, '1', '2019-11-04 13:27:19', '2019-11-04 13:27:19'),
(66, '62', 'PO Status', 'purchaseOrderStatus.index', 'fa fa-caret', 4, '1', '2019-11-04 14:06:09', '2019-11-05 14:29:09'),
(67, '49', 'Product List', 'productList.index', 'fa fa-bars', 5, '1', '2019-11-05 17:21:20', '2019-11-05 17:21:20'),
(68, '62', 'Supply & Payment Summery', 'supplyPaymentSummery.index', 'fa fa-bars', 6, '1', '2019-11-09 06:26:33', '2019-11-11 14:16:11'),
(69, '57', 'Sales & Collection Outstanding', 'salesCollectionOutstanding.index', 'fa fa-bars', 7, '1', '2019-11-11 14:17:36', '2019-11-11 14:17:36'),
(70, '57', 'Client Statement', 'clientStatement.index', 'fa fa-bars', 8, '1', '2019-11-11 16:17:10', '2019-11-11 16:17:10'),
(71, '49', 'Stock Status Report', 'stockStatusReport.index', 'fa fa-bars', 9, '1', '2019-11-13 17:26:16', '2019-11-13 17:26:16'),
(72, '57', 'Sales Contribution', 'salesContribution.index', 'fa fa-bars', 10, '1', '2019-11-14 10:43:31', '2019-11-14 10:43:31'),
(73, '49', 'Stock Valuation Report', 'stockValuationReport.index', 'fa fa-bars', 11, '1', '2019-11-14 22:43:39', '2019-11-14 22:43:39'),
(74, '49', 'Out Of Stock', 'outOfStockReport.index', 'fa fa-caret', 12, '1', '2019-11-17 12:56:24', '2019-11-17 12:56:24'),
(75, '57', 'Collection History', 'collectionHistory.index', 'fa fa-caret', 13, '1', '2019-11-17 16:29:54', '2019-11-17 16:29:54'),
(76, '57', 'Product Wise Profit', 'productWiseProfit.index', 'fa fa-caret', 14, '1', '2019-11-19 01:12:46', '2019-11-19 01:12:46'),
(77, NULL, 'Content', 'admin.index', NULL, 3, '1', '2020-02-26 22:43:53', '2020-02-26 22:43:53'),
(78, '77', 'Articles', 'articles.index', NULL, 1, '1', '2020-02-26 22:45:00', '2020-02-26 22:45:00'),
(79, '77', 'Delivery Zone', 'deliveryZone.index', NULL, 2, '1', '2020-03-03 05:02:59', '2020-03-03 05:23:55'),
(80, '77', 'Delivery Area', 'area.index', NULL, 3, '1', '2020-03-03 05:03:27', '2020-03-03 05:03:27'),
(81, '36', 'My Account', 'user.account', 'fa fa-caret-right', 5, '1', '2020-04-01 20:57:33', '2020-04-01 20:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_menu_actions`
--

CREATE TABLE `user_menu_actions` (
  `id` int(10) UNSIGNED NOT NULL,
  `parentmenuId` int(11) NOT NULL,
  `menuType` int(11) NOT NULL,
  `actionName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionLink` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orderBy` int(11) NOT NULL,
  `actionStatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_menu_actions`
--

INSERT INTO `user_menu_actions` (`id`, `parentmenuId`, `menuType`, `actionName`, `actionLink`, `orderBy`, `actionStatus`, `created_at`, `updated_at`) VALUES
(4, 15, 1, 'Add', 'categoryadd.page', 1, 1, '2019-09-02 08:09:47', '2019-09-02 08:09:47'),
(5, 15, 7, 'View', 'categories.index', 3, 1, '2019-09-02 10:13:49', '2019-09-02 10:44:44'),
(6, 15, 4, 'Delete', 'category.delete', 4, 1, '2019-09-02 10:25:39', '2019-09-02 10:44:57'),
(7, 15, 2, 'Edit', 'category.edit', 2, 1, '2019-09-02 10:39:20', '2019-09-02 11:51:37'),
(8, 14, 1, 'Add', 'productadd.page', 5, 1, '2019-09-02 11:41:50', '2019-09-02 11:50:43'),
(9, 14, 2, 'Edit', 'product.edit', 6, 1, '2019-09-02 11:48:49', '2019-09-02 11:48:49'),
(10, 42, 1, 'Add', 'cashPurchase.add', 7, 1, '2019-09-02 22:29:50', '2019-09-02 22:29:50'),
(11, 42, 2, 'Edit', 'cashPurchase.edit', 8, 1, '2019-09-03 04:03:09', '2019-09-03 04:03:09'),
(12, 42, 4, 'Delete', 'cashPurchase.delete', 9, 1, '2019-09-03 04:03:26', '2019-09-03 04:03:26'),
(13, 15, 3, 'Status', 'categories.changecategoryStatus', 10, 1, '2019-09-03 04:57:13', '2019-09-03 05:03:17'),
(14, 14, 3, 'Status', 'products.changeStatus', 11, 1, '2019-09-03 05:10:48', '2019-09-03 05:10:48'),
(15, 14, 4, 'Delete', 'single-product-destroy', 12, 1, '2019-09-03 05:11:36', '2019-09-03 05:11:36'),
(16, 16, 1, 'Add', 'chargeadd.page', 13, 1, '2019-09-03 05:18:12', '2019-09-03 05:18:12'),
(17, 16, 3, 'Status', 'shippingCharge.shippingChargeStatus', 14, 1, '2019-09-03 05:18:33', '2019-09-03 05:18:33'),
(18, 16, 2, 'Edit', 'shippingCharge.edit', 15, 1, '2019-09-03 05:18:51', '2019-09-03 05:18:51'),
(19, 16, 4, 'Delete', 'shippingCharge.delete', 16, 1, '2019-09-03 05:19:21', '2019-09-03 05:19:21'),
(20, 17, 1, 'Add', 'customerGroup.add', 17, 1, '2019-09-03 10:38:15', '2019-09-03 10:38:15'),
(21, 17, 3, 'Status', 'customerGroup.status', 18, 1, '2019-09-03 10:39:02', '2019-09-03 10:39:02'),
(22, 17, 2, 'Edit', 'customerGroup.edit', 19, 1, '2019-09-03 10:39:43', '2019-09-03 10:42:25'),
(23, 17, 4, 'Delete', 'customerGroup.delete', 20, 1, '2019-09-03 10:40:20', '2019-09-03 10:40:20'),
(24, 20, 1, 'Add', 'menuadd.page', 21, 1, '2019-09-03 10:48:02', '2019-09-03 10:48:02'),
(25, 20, 3, 'Status', 'menu.changeStatus', 22, 1, '2019-09-03 10:48:43', '2019-09-03 10:48:43'),
(26, 20, 2, 'Edit', 'menu.edit', 23, 1, '2019-09-03 10:49:08', '2019-09-03 10:49:08'),
(27, 20, 4, 'Delete', 'menu.delete', 24, 1, '2019-09-03 10:49:40', '2019-09-03 10:49:40'),
(28, 21, 1, 'Add', 'slideradd.page', 25, 1, '2019-09-03 10:50:35', '2019-09-03 10:50:35'),
(29, 21, 3, 'Status', 'sliders.changeStatus', 26, 1, '2019-09-03 10:52:05', '2019-09-03 10:52:05'),
(34, 21, 2, 'Edit', 'slider.edit', 27, 1, '2019-09-03 10:58:11', '2019-09-03 10:58:11'),
(35, 21, 4, 'Delete', 'slider.delete', 28, 1, '2019-09-03 10:58:58', '2019-09-03 10:58:58'),
(36, 23, 1, 'Add', 'policyadd.page', 29, 1, '2019-09-03 11:02:42', '2019-09-03 11:02:42'),
(37, 23, 3, 'Status', 'policies.changepolicyStatus', 30, 1, '2019-09-03 11:02:57', '2019-09-03 11:02:57'),
(38, 23, 2, 'Edit', 'policy.edit', 31, 1, '2019-09-03 11:03:21', '2019-09-03 11:03:21'),
(39, 23, 4, 'Delete', 'policy.delete', 32, 1, '2019-09-03 11:03:41', '2019-09-03 11:03:41'),
(40, 22, 1, 'Add', 'banneradd.page', 33, 1, '2019-09-03 11:05:02', '2019-09-03 11:05:02'),
(41, 22, 3, 'Status', 'banners.changebannerStatus', 34, 1, '2019-09-03 11:05:16', '2019-09-03 11:05:16'),
(42, 22, 2, 'Edit', 'banner.edit', 35, 1, '2019-09-03 11:05:32', '2019-09-03 11:05:32'),
(43, 22, 4, 'Delete', 'banner.delete', 36, 1, '2019-09-03 11:05:58', '2019-09-03 11:05:58'),
(44, 28, 3, 'Status', 'reviews.changereviewStatus', 37, 1, '2019-09-03 11:12:16', '2019-09-03 11:12:16'),
(50, 32, 1, 'Add', 'blogs.add', 1, 1, '2019-09-03 11:15:50', '2020-03-01 11:10:52'),
(51, 32, 3, 'Status', 'blogs.status', 4, 1, '2019-09-03 11:16:35', '2020-03-01 11:11:15'),
(52, 32, 2, 'Edit', 'blogs.edit', 2, 1, '2019-09-03 11:16:52', '2020-03-01 11:11:33'),
(53, 32, 4, 'Delete', 'blogs.delete', 3, 1, '2019-09-03 11:17:11', '2020-03-01 11:11:50'),
(54, 12, 8, 'View Customer Details', 'customer.customerDetails', 46, 1, '2019-09-03 11:19:00', '2019-10-30 10:27:03'),
(55, 38, 1, 'Add', 'usermenu.add', 47, 1, '2019-09-03 11:19:40', '2019-09-03 11:19:40'),
(56, 38, 2, 'Edit', 'usermenu.edit', 48, 1, '2019-09-03 11:19:55', '2019-09-03 11:19:55'),
(57, 38, 3, 'Status', 'usermenu.status', 49, 1, '2019-09-03 11:20:21', '2019-09-03 11:20:21'),
(58, 38, 4, 'Delete', 'usermenu-delete', 51, 1, '2019-09-03 11:20:37', '2019-09-06 09:25:44'),
(59, 40, 1, 'Add', 'useradd.page', 51, 1, '2019-09-03 11:23:08', '2019-09-03 11:23:08'),
(60, 40, 3, 'Status', 'user.changeuserStatus', 52, 1, '2019-09-03 11:23:26', '2019-09-03 11:23:26'),
(61, 40, 2, 'Edit', 'user.edit', 53, 1, '2019-09-03 11:23:47', '2019-09-03 11:23:47'),
(62, 40, 6, 'Change Password', 'user.password', 54, 1, '2019-09-03 11:24:12', '2019-09-03 11:24:12'),
(63, 40, 7, 'View', 'user.profile', 55, 0, '2019-09-03 11:24:50', '2019-09-06 09:31:03'),
(64, 39, 1, 'Add', 'userRoleAdd.page', 56, 1, '2019-09-03 11:25:46', '2019-09-03 11:25:46'),
(65, 39, 3, 'Status', 'userRole.changeuserRoleStatus', 57, 1, '2019-09-03 11:26:03', '2019-09-03 11:26:03'),
(66, 39, 2, 'Edit', 'userRole.edit', 58, 1, '2019-09-03 11:26:24', '2019-09-03 11:26:24'),
(67, 39, 5, 'Permission', 'userRole.permission', 59, 1, '2019-09-03 11:26:59', '2019-09-03 11:26:59'),
(68, 41, 1, 'Add', 'vendor.add', 60, 1, '2019-09-03 11:27:57', '2020-03-01 11:30:53'),
(69, 41, 2, 'Edit', 'vendor.edit', 61, 1, '2019-09-03 11:28:10', '2019-09-03 11:28:10'),
(70, 41, 3, 'Status', 'vendor.status', 62, 1, '2019-09-03 11:28:27', '2019-09-03 11:28:27'),
(71, 41, 4, 'Delete', 'vendor-delete', 63, 1, '2019-09-03 11:28:50', '2019-09-03 11:28:50'),
(72, 44, 1, 'Add', 'creditPurchase.add', 1, 1, '2019-09-03 22:25:29', '2019-09-03 22:25:29'),
(73, 44, 2, 'Edit', 'creditPurchase.edit', 2, 1, '2019-09-03 22:25:46', '2019-09-03 22:25:46'),
(74, 44, 3, 'Status', 'creditPurchase.status', 3, 1, '2019-09-03 22:26:08', '2019-09-03 22:26:08'),
(75, 44, 4, 'Delete', 'creditPurchase.destroy', 4, 1, '2019-09-03 22:26:48', '2019-09-03 22:27:02'),
(76, 45, 1, 'Add', 'purchaseOrder.add', 64, 1, '2019-09-04 03:37:02', '2019-09-04 03:37:02'),
(77, 45, 2, 'Edit', 'purchaseOrder.edit', 65, 1, '2019-09-04 03:37:12', '2019-09-04 03:37:12'),
(78, 45, 4, 'Cancel', 'purchaseOrder.destroy', 67, 1, '2019-09-04 03:37:28', '2019-09-04 05:10:12'),
(79, 45, 8, 'View', 'purchaseOrder.view', 66, 1, '2019-09-04 05:09:34', '2019-09-04 05:09:34'),
(80, 46, 1, 'Add', 'purchaseOrderReceive.add', 68, 1, '2019-09-04 05:44:04', '2019-09-04 05:44:04'),
(81, 46, 2, 'Edit', 'purchaseOrderReceive.edit', 69, 1, '2019-09-04 05:44:16', '2019-09-04 05:44:16'),
(82, 46, 4, 'Delete', 'purchaseOrderReceive.delete', 70, 1, '2019-09-04 05:44:45', '2019-09-04 05:44:45'),
(83, 47, 1, 'Add', 'supplierPayment.add', 71, 1, '2019-09-05 02:45:15', '2019-09-05 02:45:15'),
(84, 47, 2, 'Edit', 'supplierPayment.edit', 72, 1, '2019-09-05 02:45:27', '2019-09-05 02:45:27'),
(85, 47, 4, 'Delete', 'supplierPayment.delete', 73, 1, '2019-09-05 02:46:24', '2019-09-05 02:46:24'),
(86, 38, 8, 'View Action Menu', 'usermenuLink.index', 50, 1, '2019-09-06 09:26:39', '2019-09-06 09:26:39'),
(87, 39, 4, 'Delete User Role', 'userRole.delete', 60, 1, '2019-09-06 09:29:36', '2019-09-06 09:30:18'),
(88, 40, 4, 'Delete User', 'user.delete', 56, 1, '2019-09-06 09:31:27', '2019-09-06 09:31:27'),
(89, 34, 4, 'Delete', 'subscriber.delete', 74, 1, '2019-09-06 09:36:56', '2019-09-06 09:36:56'),
(90, 7, 9, 'Order Shipping Status', 'order.new', 1, 1, '2019-09-06 10:54:38', '2019-09-06 10:54:38'),
(91, 7, 10, 'Product List', 'list.product', 2, 1, '2019-09-06 10:56:53', '2019-09-06 10:56:53'),
(92, 7, 8, 'View Invoice', 'view.invoices', 3, 1, '2019-09-06 10:57:49', '2019-09-06 10:57:49'),
(93, 7, 4, 'Delete Pending Order', 'order.delete', 4, 1, '2019-09-06 10:58:40', '2019-09-06 11:07:40'),
(94, 8, 9, 'Order Shipping Status', 'order.new', 1, 1, '2019-09-06 11:01:30', '2019-09-06 11:01:30'),
(95, 8, 10, 'Product List', 'list.product', 2, 1, '2019-09-06 11:01:51', '2019-09-06 11:01:51'),
(96, 8, 8, 'View Invoice', 'view.invoices', 3, 1, '2019-09-06 11:02:10', '2019-09-06 11:02:10'),
(97, 8, 4, 'Delete Processing Order', 'order.delete', 4, 1, '2019-09-06 11:02:50', '2019-09-06 11:02:50'),
(98, 10, 9, 'Order Shipping Status', 'order.new', 1, 1, '2019-09-06 11:03:49', '2019-09-06 11:03:49'),
(99, 10, 10, 'Product List', 'list.product', 2, 1, '2019-09-06 11:04:18', '2019-09-06 11:04:18'),
(100, 10, 8, 'View Invoice', 'view.invoices', 3, 1, '2019-09-06 11:04:37', '2019-09-06 11:04:37'),
(101, 10, 4, 'Delete Shipping Order', 'order.delete', 4, 1, '2019-09-06 11:05:11', '2019-09-06 11:05:11'),
(102, 11, 9, 'Order Shipping Status', 'order.new', 1, 1, '2019-09-06 11:06:08', '2019-09-06 11:06:08'),
(103, 11, 10, 'Product List', 'list.product', 2, 1, '2019-09-06 11:06:32', '2019-09-06 11:06:32'),
(104, 11, 8, 'View Invoice', 'view.invoices', 3, 1, '2019-09-06 11:06:50', '2019-09-06 11:06:50'),
(105, 11, 4, 'Delete Complete Order', 'order.delete', 4, 1, '2019-09-06 11:07:19', '2019-09-06 11:07:19'),
(106, 12, 4, 'Delete Customer', 'customer.delete', 47, 1, '2019-09-06 11:17:38', '2019-09-06 11:17:38'),
(107, 48, 1, 'Add', 'purchaseReturn.add', 1, 1, '2019-09-06 23:52:51', '2019-09-06 23:52:51'),
(108, 48, 2, 'Edit', 'purchaseReturn.edit', 2, 1, '2019-09-07 00:05:17', '2019-09-07 00:05:17'),
(109, 48, 4, 'Delete Purchase Return', 'purchaseReturn.delete', 3, 1, '2019-09-07 00:05:38', '2019-09-07 00:05:38'),
(110, 51, 11, 'View PDF', 'supplierStatement.prints', 75, 1, '2019-09-08 04:33:19', '2019-09-08 04:33:19'),
(111, 50, 11, 'Print Purchase Log', 'purchaseLog.print', 1, 1, '2019-09-09 01:45:43', '2019-09-09 02:55:22'),
(112, 53, 1, 'Add', 'cashSale.add', 76, 1, '2019-10-13 04:07:49', '2019-10-13 04:07:49'),
(113, 53, 2, 'Edit', 'cashSale.edit', 77, 1, '2019-10-14 03:21:02', '2019-10-14 03:21:02'),
(114, 53, 4, 'Delete', 'cashSale.destroy', 78, 1, '2019-10-14 03:21:49', '2019-10-14 03:21:49'),
(115, 54, 1, 'Add', 'creditSale.add', 79, 1, '2019-10-14 05:42:47', '2019-10-14 05:42:47'),
(116, 54, 2, 'Edit', 'creditSale.edit', 80, 1, '2019-10-14 05:43:07', '2019-10-14 05:43:07'),
(117, 54, 4, 'Delete', 'creditSale.destroy', 81, 1, '2019-10-14 05:43:22', '2019-10-14 05:43:22'),
(118, 55, 1, 'Add', 'clientEntry.add', 82, 1, '2019-10-14 06:33:32', '2019-10-14 06:33:32'),
(119, 55, 2, 'Edit', 'clientEntry.edit', 83, 1, '2019-10-14 06:33:45', '2019-10-14 06:33:45'),
(120, 55, 4, 'Delete', 'clientEntry.destroy', 85, 1, '2019-10-14 06:34:01', '2019-10-30 10:18:36'),
(121, 56, 1, 'Add', 'creditCollection.add', 85, 1, '2019-10-15 23:48:28', '2019-10-15 23:48:28'),
(122, 56, 2, 'Edit', 'creditCollection.edit', 86, 1, '2019-10-15 23:48:48', '2019-10-15 23:48:48'),
(123, 56, 4, 'Delete', 'creditCollection.destroy', 87, 1, '2019-10-15 23:49:07', '2019-10-15 23:49:07'),
(124, 58, 11, 'Print Sales History', 'salesHistory.prints', 88, 1, '2019-10-17 00:43:03', '2019-10-17 00:43:03'),
(125, 59, 11, 'Print Product Wise Sales', 'productWiseSales.prints', 89, 1, '2019-10-17 00:43:58', '2019-10-17 00:43:58'),
(126, 60, 11, 'Print Client Wise Sales', 'clientWiseSales.prints', 90, 1, '2019-10-17 00:44:37', '2019-10-17 00:44:37'),
(128, 63, 11, 'Print Purchase History', 'purchaseHistory.print', 91, 1, '2019-10-31 16:32:57', '2019-10-31 16:32:57'),
(129, 64, 11, 'Print Purchase Return History', 'purchaseReturnHistory.print', 92, 1, '2019-11-02 10:27:18', '2019-11-02 10:27:18'),
(130, 65, 11, 'Print Payment Log', 'paymentLog.print', 93, 1, '2019-11-04 13:28:46', '2019-11-04 13:28:46'),
(131, 66, 11, 'Print PO Status', 'purchaseOrderStatus.print', 94, 1, '2019-11-04 14:07:20', '2019-11-05 14:28:33'),
(132, 67, 11, 'Print Product List', 'productList.print', 95, 1, '2019-11-05 17:22:04', '2019-11-05 17:22:04'),
(133, 68, 11, 'Print Supply & Payment Summery', 'supplyPaymentSummery.print', 96, 1, '2019-11-09 06:29:38', '2019-11-11 14:16:54'),
(134, 69, 11, 'Print Sales & Collection Standings', 'salesCollectionOutstanding.print', 97, 1, '2019-11-11 14:18:45', '2019-11-11 14:18:45'),
(135, 70, 11, 'Print Client Statement', 'clientStatement.print', 98, 1, '2019-11-11 16:17:50', '2019-11-11 16:17:50'),
(136, 71, 11, 'Print Stock Status Report', 'stockStatusReport.print', 99, 1, '2019-11-13 17:27:04', '2019-11-13 17:27:04'),
(137, 72, 11, 'Print Sales Contribution', 'salesContribution.print', 100, 1, '2019-11-14 10:44:23', '2019-11-14 10:44:23'),
(138, 73, 11, 'Print Stock Valuation Report', 'stockValuationReport.print', 101, 1, '2019-11-14 22:44:37', '2019-11-14 22:44:37'),
(139, 74, 11, 'Print Out Of Stock', 'outOfStockReport.print', 102, 1, '2019-11-17 12:57:14', '2019-11-17 12:57:14'),
(140, 75, 11, 'Print Collection History', 'collectionHistory.print', 103, 1, '2019-11-17 16:30:37', '2019-11-17 16:30:37'),
(141, 76, 11, 'Print Product Wise Profit', 'productWiseProfit.print', 104, 1, '2019-11-19 01:13:47', '2019-11-19 01:13:47'),
(142, 28, 8, 'View Details', 'review.reviewDetails', 1, 1, '2020-02-06 05:41:12', '2020-02-06 05:41:12'),
(143, 78, 1, 'Add', 'articles.add', 1, 1, '2020-02-26 22:45:45', '2020-02-26 22:45:45'),
(144, 78, 2, 'Edit', 'articles.edit', 2, 1, '2020-02-26 22:46:00', '2020-02-26 22:46:00'),
(145, 78, 4, 'Delete', 'articles.delete', 3, 1, '2020-02-26 22:46:15', '2020-02-26 22:46:15'),
(146, 78, 3, 'Status', 'articles.status', 4, 1, '2020-02-26 22:46:39', '2020-02-26 22:46:39'),
(147, 24, 1, 'Add', 'social.add', 1, 1, '2020-03-01 10:38:01', '2020-03-01 10:38:01'),
(148, 24, 2, 'Edit', 'social.edit', 2, 1, '2020-03-01 10:38:14', '2020-03-01 10:38:14'),
(149, 24, 4, 'Delete', 'social.delete', 3, 1, '2020-03-01 10:38:33', '2020-03-01 10:38:33'),
(150, 24, 3, 'Status', 'social.status', 4, 1, '2020-03-01 10:38:57', '2020-03-01 10:38:57'),
(152, 26, 8, 'Details', 'contact.contactDetails', 1, 1, '2020-03-01 10:55:11', '2020-03-01 10:55:11'),
(153, 80, 1, 'Add', 'area.add', 1, 1, '2020-03-03 05:04:33', '2020-03-03 05:04:33'),
(154, 80, 2, 'Edit', 'area.edit', 2, 1, '2020-03-03 05:04:47', '2020-03-03 05:04:47'),
(155, 80, 4, 'Delete', 'area.destroy', 3, 1, '2020-03-03 05:05:05', '2020-03-03 05:06:15'),
(156, 80, 3, 'Status', 'area.status', 4, 1, '2020-03-03 05:05:40', '2020-03-03 05:05:40'),
(157, 79, 1, 'Add', 'deliveryZone.add', 1, 1, '2020-03-03 05:24:20', '2020-03-03 05:40:21'),
(158, 79, 2, 'Edit', 'deliveryZone.edit', 2, 1, '2020-03-03 05:24:33', '2020-03-03 05:24:33'),
(159, 79, 4, 'Delete', 'deliveryZone.destroy', 3, 1, '2020-03-03 05:24:44', '2020-03-03 05:25:41'),
(160, 79, 3, 'Status', 'deliveryZone.status', 4, 1, '2020-03-03 05:25:11', '2020-03-03 05:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `parentRole` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `permission` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actionPermission` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `parentRole`, `level`, `name`, `status`, `permission`, `actionPermission`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 'Editor', 1, '3,6,7,8,10,11,12,13,14,15,16,17,41,55,18,19,20,21,22,23,24,36,37,38,39,40,81,43,42,44,45,46,47,48,49,50,67,71,73,74,52,53,54,56,57,58,59,60,69,70,72,75,76,62,51,63,64,65,66,68,77,78,79,80', '90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,8,9,14,15,4,7,5,6,13,16,17,18,19,20,21,22,23,68,69,70,71,118,119,120,24,25,26,27,28,29,34,35,40,41,42,43,36,37,38,39,147,148,149,150,55,56,57,86,58,64,65,66,67,87,59,60,61,62,88,10,11,12,72,73,74,75,76,77,79,78,80,81,82,83,84,85,107,108,109,111,132,136,138,139,112,113,114,115,116,117,121,122,123,124,125,126,134,135,137,140,141,110,128,129,130,131,133,143,144,145,146,157,158,159,160,153,154,155,156', '2020-02-29 00:55:19', '2020-04-01 20:59:48'),
(2, NULL, 1, 'Super User', 1, '3,6,7,8,10,11,12,13,14,15,16,17,41,55,18,19,20,21,22,23,24,36,37,38,39,40,81,43,42,44,45,46,47,48,49,50,67,71,73,74,52,53,54,56,57,58,59,60,69,70,72,75,76,62,51,63,64,65,66,68,77,78,79,80', '90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,8,9,14,15,4,7,5,6,13,16,17,18,19,20,21,22,23,68,69,70,71,118,119,120,24,25,26,27,28,29,34,35,40,41,42,43,36,37,38,39,147,148,149,150,55,56,57,86,58,64,65,66,67,87,59,60,61,62,88,10,11,12,72,73,74,75,76,77,79,78,80,81,82,83,84,85,107,108,109,111,132,136,138,139,112,113,114,115,116,117,121,122,123,124,125,126,134,135,137,140,141,110,128,129,130,131,133,143,144,145,146,157,158,159,160,153,154,155,156', '2019-04-17 00:50:05', '2020-04-01 20:58:02'),
(3, 2, 2, 'Admin', 1, '3,6,7,8,10,11,12,13,14,15,16,17,41,55,18,19,21,22,23,24,26,36,37,39,40,81,43,42,44,45,46,47,48,49,50,67,71,73,74,52,53,54,56,57,58,59,60,69,70,72,75,76,62,51,63,64,65,66,68,77,78,79,80', '90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,8,9,14,15,4,7,5,6,13,16,17,18,19,20,21,22,23,68,69,70,71,118,119,120,28,29,34,35,40,41,42,43,36,37,38,39,147,148,149,150,152,64,65,66,67,87,59,60,61,62,88,10,11,12,72,73,74,75,76,77,79,78,80,81,82,83,84,85,107,108,109,111,132,136,138,139,112,113,114,115,116,117,121,122,123,124,125,126,134,135,137,140,141,110,128,129,130,131,133,143,144,145,146,157,158,159,160,153,154,155,156', '2019-04-17 00:52:54', '2020-04-01 21:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_serial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendorName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactPerson` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendorAddress` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendorPhone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendorEmail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accountCode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) NOT NULL,
  `vendorStatus` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `vendor_serial`, `vendorName`, `contactPerson`, `vendorAddress`, `vendorPhone`, `vendorEmail`, `accountCode`, `orderBy`, `vendorStatus`, `created_at`, `updated_at`) VALUES
(1, '123', 'SR Enterprise', 'Rakib Hasan', NULL, '01567568568', NULL, NULL, 1, 1, '2020-01-22 17:37:35', '2020-01-22 17:37:35');

-- --------------------------------------------------------

--
-- Table structure for table `verify_customers`
--

CREATE TABLE `verify_customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmPassword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `verifyCode` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verify_customers`
--

INSERT INTO `verify_customers` (`id`, `name`, `email`, `mobile`, `address`, `gender`, `password`, `confirmPassword`, `verifyCode`, `created_at`, `updated_at`) VALUES
(1, 'Kawsar Ahmed Parvez', 'parveznimsar@gmail.com', '1682875065', 'La-Montana,House:33,Sector:11,Road:Gareeb-e-newaz,Uttara,Dhaka-1230,Bangladesh.', NULL, '73772ba6483341303ba2cfb69bbe2b3e', '73772ba6483341303ba2cfb69bbe2b3e', '7144808', '2020-03-08 17:32:42', '2020-03-08 17:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE `zone` (
  `id` int(2) UNSIGNED NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `bn_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES
(1, 'Uttara', NULL, '2020-03-11 01:29:42', '2020-03-11 01:29:42'),
(2, 'Badda', NULL, '2020-03-11 01:29:52', '2020-03-11 01:29:52'),
(3, 'Mirpur', NULL, '2020-03-11 01:30:00', '2020-03-11 01:30:00'),
(4, 'Dhanmondi', NULL, '2020-03-11 01:30:12', '2020-03-11 01:30:12'),
(5, 'Zatrabari', NULL, '2020-03-11 01:30:20', '2020-03-11 01:30:20');

-- --------------------------------------------------------

--
-- Structure for view `client_statement_report`
--
DROP TABLE IF EXISTS `client_statement_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`shopnbuycom`@`localhost` SQL SECURITY DEFINER VIEW `client_statement_report`  AS  select `credit_sales`.`customer_id` AS `customerId`,`credit_sales`.`payment_type` AS `type`,`credit_sales`.`invoice_date` AS `date`,`credit_sales`.`net_amount` AS `sales`,0 AS `collection`,0 AS `others`,`credit_sales`.`delivery_zone_id` AS `delivery_zone_id` from `credit_sales` union all select `credit_collections`.`client_id` AS `customerId`,'Collection' AS `type`,`credit_collections`.`payment_date` AS `date`,0 AS `sales`,`credit_collections`.`payment_amount` AS `collection`,0 AS `others`,`credit_collections`.`delivery_zone_id` AS `delivery_zone_id` from `credit_collections` order by `type`,`customerId` ;

-- --------------------------------------------------------

--
-- Structure for view `product_wise_profit`
--
DROP TABLE IF EXISTS `product_wise_profit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`shopnbuycom`@`localhost` SQL SECURITY DEFINER VIEW `product_wise_profit`  AS  select `cash_sales`.`invoice_date` AS `date`,`products`.`id` AS `productId`,`products`.`category_id` AS `categoryId`,`cash_sale_items`.`item_quantity` AS `cashProductQty`,`cash_sale_items`.`item_price` AS `cashPriceAmount`,`cash_sale_items`.`item_price` * 4.5 / 100 AS `cashVatAmount`,`cash_sale_items`.`item_price` * `cash_sales`.`discount_as` / 100 AS `cashDiscountAmount`,0 AS `creditProductQty`,0 AS `creditPriceAmount`,0 AS `creditVatAmount`,0 AS `creditDiscountAmount`,`cash_sales`.`delivery_zone_id` AS `delivery_zone_id` from ((`cash_sales` join `cash_sale_items` on(`cash_sale_items`.`cash_sale_id` = `cash_sales`.`id`)) join `products` on(`products`.`id` = `cash_sale_items`.`item_id`)) union all select `credit_sales`.`invoice_date` AS `date`,`products`.`id` AS `productId`,`products`.`category_id` AS `categoryId`,0 AS `cashProductQty`,0 AS `cashPriceAmount`,0 AS `cashVatAmount`,0 AS `cashDiscountAmount`,`credit_sale_items`.`item_quantity` AS `creditProductQty`,`credit_sale_items`.`item_price` AS `creditPriceAmount`,`credit_sale_items`.`item_price` * 4.5 / 100 AS `creditVatAmount`,`credit_sale_items`.`item_price` * `credit_sales`.`discount_as` / 100 AS `creditDiscountAmount`,`credit_sales`.`delivery_zone_id` AS `delivery_zone_id` from ((`credit_sales` join `credit_sale_items` on(`credit_sale_items`.`credit_sale_id` = `credit_sales`.`id`)) join `products` on(`products`.`id` = `credit_sale_items`.`item_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `purchase_order_status`
--
DROP TABLE IF EXISTS `purchase_order_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`shopnbuycom`@`localhost` SQL SECURITY DEFINER VIEW `purchase_order_status`  AS  select `purchase_orders`.`supplier_id` AS `supplierId`,`purchase_orders`.`order_no` AS `orderNo`,`purchase_orders`.`order_date` AS `date`,`purchase_order_items`.`product_id` AS `productId`,`purchase_orders`.`delivery_zone_id` AS `delivery_zone_id`,`purchase_order_items`.`qty` AS `orderQty`,0 AS `receiveQty` from (`purchase_orders` join `purchase_order_items` on(`purchase_order_items`.`purchase_order_id` = `purchase_orders`.`id`)) union all select `purchase_orders`.`supplier_id` AS `supplierId`,`purchase_orders`.`order_no` AS `orderNo`,`purchase_orders`.`order_date` AS `date`,`purchase_order_receive_items`.`product_id` AS `productId`,`purchase_orders`.`delivery_zone_id` AS `delivery_zone_id`,0 AS `orderQty`,`purchase_order_receive_items`.`qty` AS `receiveQty` from ((`purchase_order_receives` join `purchase_order_receive_items` on(`purchase_order_receive_items`.`purchase_order_receive_id` = `purchase_order_receives`.`id`)) join `purchase_orders` on(`purchase_orders`.`id` = `purchase_order_receives`.`purchaseOrderNo`)) ;

-- --------------------------------------------------------

--
-- Structure for view `sales_collection_standings`
--
DROP TABLE IF EXISTS `sales_collection_standings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`shopnbuycom`@`localhost` SQL SECURITY DEFINER VIEW `sales_collection_standings`  AS  select `credit_sales`.`customer_id` AS `customerId`,`credit_sales`.`payment_type` AS `type`,`credit_sales`.`invoice_date` AS `date`,`credit_sales`.`net_amount` AS `sales`,0 AS `collection`,`credit_sales`.`delivery_zone_id` AS `delivery_zone_id` from `credit_sales` union all select `credit_collections`.`client_id` AS `customerId`,'Collection' AS `type`,`credit_collections`.`payment_date` AS `date`,0 AS `sales`,`credit_collections`.`payment_amount` AS `collection`,`credit_collections`.`delivery_zone_id` AS `delivery_zone_id` from `credit_collections` order by `type`,`customerId` ;

-- --------------------------------------------------------

--
-- Structure for view `sales_contribution`
--
DROP TABLE IF EXISTS `sales_contribution`;

CREATE ALGORITHM=UNDEFINED DEFINER=`shopnbuycom`@`localhost` SQL SECURITY DEFINER VIEW `sales_contribution`  AS  select `products`.`category_id` AS `categoryId`,`cash_sale_items`.`item_id` AS `productId`,sum(`cash_sale_items`.`item_quantity`) AS `cashSaleQty`,sum(`cash_sale_items`.`item_price`) AS `cashSaleAmount`,0 AS `creditSaleQty`,0 AS `creditSaleAmount`,`cash_sale_items`.`delivery_zone_id` AS `delivery_zone_id` from (`cash_sale_items` join `products` on(`products`.`id` = `cash_sale_items`.`item_id`)) group by `cash_sale_items`.`item_id` union all select `products`.`category_id` AS `categoryId`,`credit_sale_items`.`item_id` AS `productId`,0 AS `cashSaleQty`,0 AS `cashSaleAmount`,sum(`credit_sale_items`.`item_quantity`) AS `creditSaleQty`,sum(`credit_sale_items`.`item_price`) AS `creditSaleAmount`,`credit_sale_items`.`delivery_zone_id` AS `delivery_zone_id` from (`credit_sale_items` join `products` on(`products`.`id` = `credit_sale_items`.`item_id`)) group by `credit_sale_items`.`item_id` ;

-- --------------------------------------------------------

--
-- Structure for view `stock_status_report`
--
DROP TABLE IF EXISTS `stock_status_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`shopnbuycom`@`localhost` SQL SECURITY DEFINER VIEW `stock_status_report`  AS  select `purchase_orders`.`supplier_id` AS `supplierId`,`purchase_order_receives`.`receive_date` AS `date`,`products`.`category_id` AS `categoryId`,`purchase_order_receive_items`.`product_id` AS `productId`,`purchase_order_receive_items`.`qty` AS `receiveQty`,`purchase_order_receive_items`.`amount` AS `receiveAmount`,0 AS `cashSaleQty`,0 AS `creditSaleQty`,`purchase_orders`.`delivery_zone_id` AS `delivery_zone_id` from (((`purchase_orders` join `purchase_order_receives` on(`purchase_order_receives`.`purchaseOrderNo` = `purchase_orders`.`id`)) join `purchase_order_receive_items` on(`purchase_order_receive_items`.`purchase_order_receive_id` = `purchase_order_receives`.`id`)) join `products` on(`products`.`id` = `purchase_order_receive_items`.`product_id`)) union all select `purchase_orders`.`supplier_id` AS `supplierId`,`cash_sales`.`invoice_date` AS `date`,`products`.`category_id` AS `categoryId`,`cash_sale_items`.`item_id` AS `productId`,0 AS `receiveQty`,0 AS `receiveAmount`,`cash_sale_items`.`item_quantity` AS `cashSaleQty`,0 AS `creditSaleQty`,`purchase_orders`.`delivery_zone_id` AS `delivery_zone_id` from (((((`purchase_orders` join `purchase_order_receives` on(`purchase_order_receives`.`purchaseOrderNo` = `purchase_orders`.`id`)) join `purchase_order_receive_items` on(`purchase_order_receive_items`.`purchase_order_receive_id` = `purchase_order_receives`.`id`)) join `products` on(`products`.`id` = `purchase_order_receive_items`.`product_id`)) join `cash_sale_items` on(`cash_sale_items`.`item_id` = `purchase_order_receive_items`.`product_id`)) join `cash_sales` on(`cash_sales`.`id` = `cash_sale_items`.`cash_sale_id`)) group by `purchase_orders`.`supplier_id`,`cash_sales`.`invoice_date`,`products`.`category_id`,`cash_sale_items`.`item_id` union all select `purchase_orders`.`supplier_id` AS `supplierId`,`credit_sales`.`invoice_date` AS `date`,`products`.`category_id` AS `categoryId`,`credit_sale_items`.`item_id` AS `productId`,0 AS `receiveQty`,0 AS `receiveAmount`,0 AS `cashSaleQty`,`credit_sale_items`.`item_quantity` AS `creditSaleQty`,`purchase_orders`.`delivery_zone_id` AS `delivery_zone_id` from (((((`purchase_orders` join `purchase_order_receives` on(`purchase_order_receives`.`purchaseOrderNo` = `purchase_orders`.`id`)) join `purchase_order_receive_items` on(`purchase_order_receive_items`.`purchase_order_receive_id` = `purchase_order_receives`.`id`)) join `products` on(`products`.`id` = `purchase_order_receive_items`.`product_id`)) join `credit_sale_items` on(`credit_sale_items`.`item_id` = `purchase_order_receive_items`.`product_id`)) join `credit_sales` on(`credit_sales`.`id` = `credit_sale_items`.`credit_sale_id`)) group by `purchase_orders`.`supplier_id`,`credit_sales`.`invoice_date`,`products`.`category_id`,`credit_sale_items`.`item_id` ;

-- --------------------------------------------------------

--
-- Structure for view `stock_valuation_report`
--
DROP TABLE IF EXISTS `stock_valuation_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`shopnbuycom`@`localhost` SQL SECURITY DEFINER VIEW `stock_valuation_report`  AS  select `cash_purchase`.`supplier_id` AS `supplierId`,`products`.`category_id` AS `categoryId`,`cash_purchase_item`.`product_id` AS `productId`,`cash_purchase_item`.`qty` AS `cashPurchaseQty`,`cash_purchase_item`.`amount` AS `cashPurchaseAmount`,0 AS `creditPurchaseQty`,0 AS `creditPurchaseAmount`,0 AS `purchaseReturnQty`,0 AS `purchaseReturnAmount`,0 AS `cashSaleQty`,0 AS `cashSaleAmount`,0 AS `creditSaleQty`,0 AS `creditSaleAmount`,0 AS `salesReturnQty`,`cash_purchase`.`delivery_zone_id` AS `delivery_zone_id` from ((`cash_purchase_item` join `cash_purchase` on(`cash_purchase`.`id` = `cash_purchase_item`.`cash_puchase_id`)) join `products` on(`products`.`id` = `cash_purchase_item`.`product_id`)) union all select `credit_purchases`.`supplier_id` AS `supplierId`,`products`.`category_id` AS `categoryId`,`credit_purchase_items`.`product_id` AS `productId`,0 AS `cashPurchaseQty`,0 AS `cashPurchaseAmount`,`credit_purchase_items`.`qty` AS `creditPurchaseQty`,`credit_purchase_items`.`amount` AS `creditPurchaseAmount`,0 AS `purchaseReturnQty`,0 AS `purchaseReturnAmount`,0 AS `cashSaleQty`,0 AS `cashSaleAmount`,0 AS `creditSaleQty`,0 AS `creditSaleAmount`,0 AS `salesReturnQty`,`credit_purchases`.`delivery_zone_id` AS `delivery_zone_id` from ((`credit_purchase_items` join `credit_purchases` on(`credit_purchases`.`id` = `credit_purchase_items`.`credit_puchase_id`)) join `products` on(`products`.`id` = `credit_purchase_items`.`product_id`)) union all select `purchase_returns`.`supplier_id` AS `supplierId`,`products`.`category_id` AS `categoryId`,`purchase_return_items`.`product_id` AS `productId`,0 AS `cashPurchaseQty`,0 AS `cashPurchaseAmount`,0 AS `creditPurchaseQty`,0 AS `creditPurchaseAmount`,`purchase_return_items`.`qty` AS `purchaseReturnQty`,`purchase_return_items`.`amount` AS `purchaseReturnAmount`,0 AS `cashSaleQty`,0 AS `cashSaleAmount`,0 AS `creditSaleQty`,0 AS `creditSaleAmount`,0 AS `salesReturnQty`,`purchase_returns`.`delivery_zone_id` AS `delivery_zone_id` from ((`purchase_return_items` join `purchase_returns` on(`purchase_returns`.`id` = `purchase_return_items`.`purchase_return_id`)) join `products` on(`products`.`id` = `purchase_return_items`.`product_id`)) union all select 0 AS `supplierId`,`products`.`category_id` AS `categoryId`,`cash_sale_items`.`item_id` AS `productId`,0 AS `cashPurchaseQty`,0 AS `cashPurchaseAmount`,0 AS `creditPurchaseQty`,0 AS `creditPurchaseAmount`,0 AS `purchaseReturnQty`,0 AS `purchaseReturnAmount`,`cash_sale_items`.`item_quantity` AS `cashSaleQty`,`cash_sale_items`.`item_price` AS `cashSaleAmount`,0 AS `creditSaleQty`,0 AS `creditSaleAmount`,0 AS `salesReturnQty`,`cash_sale_items`.`delivery_zone_id` AS `delivery_zone_id` from (`cash_sale_items` join `products` on(`products`.`id` = `cash_sale_items`.`item_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `supplier_statement_report`
--
DROP TABLE IF EXISTS `supplier_statement_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`shopnbuycom`@`localhost` SQL SECURITY DEFINER VIEW `supplier_statement_report`  AS  select `credit_purchases`.`type` AS `type`,`credit_purchases`.`voucher_date` AS `date`,sum(`credit_purchases`.`total_amount`) AS `lifting`,0 AS `payment`,0 AS `others`,`credit_purchases`.`supplier_id` AS `vendorId`,`credit_purchases`.`delivery_zone_id` AS `delivery_zone_id` from `credit_purchases` group by `credit_purchases`.`voucher_date`,`credit_purchases`.`supplier_id`,`credit_purchases`.`type` union select `cash_purchase`.`type` AS `type`,`cash_purchase`.`voucher_date` AS `date`,sum(`cash_purchase`.`total_amount`) AS `lifting`,0 AS `payment`,0 AS `others`,`cash_purchase`.`supplier_id` AS `vendorId`,`cash_purchase`.`delivery_zone_id` AS `delivery_zone_id` from `cash_purchase` group by `cash_purchase`.`voucher_date`,`cash_purchase`.`supplier_id`,`cash_purchase`.`type` union select `supplier_payments`.`payment_type` AS `type`,`supplier_payments`.`payment_date` AS `date`,0 AS `lifting`,sum(`supplier_payments`.`payment_now`) AS `payment`,0 AS `others`,`supplier_payments`.`supplier_id` AS `vendorId`,`supplier_payments`.`delivery_zone_id` AS `delivery_zone_id` from `supplier_payments` group by `supplier_payments`.`payment_date`,`supplier_payments`.`supplier_id`,`supplier_payments`.`payment_type` union select '' AS `type`,`purchase_returns`.`purchase_return_date` AS `date`,0 AS `lifting`,0 AS `payment`,sum(`purchase_returns`.`total_amount`) AS `others`,`purchase_returns`.`supplier_id` AS `vendorId`,`purchase_returns`.`delivery_zone_id` AS `delivery_zone_id` from `purchase_returns` group by `purchase_returns`.`purchase_return_date`,`purchase_returns`.`supplier_id` order by `date` ;

-- --------------------------------------------------------

--
-- Structure for view `supply_payment_summery`
--
DROP TABLE IF EXISTS `supply_payment_summery`;

CREATE ALGORITHM=UNDEFINED DEFINER=`shopnbuycom`@`localhost` SQL SECURITY DEFINER VIEW `supply_payment_summery`  AS  select `cash_purchase`.`supplier_id` AS `supplierId`,`cash_purchase`.`type` AS `type`,`cash_purchase`.`voucher_date` AS `date`,`cash_purchase`.`total_amount` AS `purchase`,`cash_purchase`.`total_amount` AS `payment`,`cash_purchase`.`delivery_zone_id` AS `delivery_zone_id` from `cash_purchase` union all select `credit_purchases`.`supplier_id` AS `supplierId`,`credit_purchases`.`type` AS `type`,`credit_purchases`.`voucher_date` AS `date`,`credit_purchases`.`total_amount` AS `purchase`,0 AS `payment`,`credit_purchases`.`delivery_zone_id` AS `delivery_zone_id` from `credit_purchases` union all select `purchase_orders`.`supplier_id` AS `supplierId`,'Order Receive' AS `type`,`purchase_order_receives`.`receive_date` AS `date`,`purchase_order_receives`.`total_amount` AS `purchase`,0 AS `payment`,`purchase_orders`.`delivery_zone_id` AS `delivery_zone_id` from (`purchase_orders` join `purchase_order_receives` on(`purchase_order_receives`.`purchaseOrderNo` = `purchase_orders`.`id`)) union all select `supplier_payments`.`supplier_id` AS `supplierId`,'Payment' AS `type`,`supplier_payments`.`payment_date` AS `date`,0 AS `purchase`,`supplier_payments`.`payment_now` AS `payment`,`supplier_payments`.`delivery_zone_id` AS `delivery_zone_id` from `supplier_payments` order by `type`,`supplierId` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_purchase`
--
ALTER TABLE `cash_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_purchase_item`
--
ALTER TABLE `cash_purchase_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_sales`
--
ALTER TABLE `cash_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_sale_items`
--
ALTER TABLE `cash_sale_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_entries`
--
ALTER TABLE `client_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactuses`
--
ALTER TABLE `contactuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_collections`
--
ALTER TABLE `credit_collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_purchases`
--
ALTER TABLE `credit_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_purchase_items`
--
ALTER TABLE `credit_purchase_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_sales`
--
ALTER TABLE `credit_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_sale_items`
--
ALTER TABLE `credit_sale_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_groups`
--
ALTER TABLE `customer_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_group_sections`
--
ALTER TABLE `customer_group_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flash_sell`
--
ALTER TABLE `flash_sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header_block`
--
ALTER TABLE `header_block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help_centers`
--
ALTER TABLE `help_centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sections`
--
ALTER TABLE `product_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_receives`
--
ALTER TABLE `purchase_order_receives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_receive_items`
--
ALTER TABLE `purchase_order_receive_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_return_items`
--
ALTER TABLE `purchase_return_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menus`
--
ALTER TABLE `user_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu_actions`
--
ALTER TABLE `user_menu_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify_customers`
--
ALTER TABLE `verify_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cash_purchase`
--
ALTER TABLE `cash_purchase`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cash_purchase_item`
--
ALTER TABLE `cash_purchase_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cash_sales`
--
ALTER TABLE `cash_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cash_sale_items`
--
ALTER TABLE `cash_sale_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `client_entries`
--
ALTER TABLE `client_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactuses`
--
ALTER TABLE `contactuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_collections`
--
ALTER TABLE `credit_collections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `credit_purchases`
--
ALTER TABLE `credit_purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `credit_purchase_items`
--
ALTER TABLE `credit_purchase_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `credit_sales`
--
ALTER TABLE `credit_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `credit_sale_items`
--
ALTER TABLE `credit_sale_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_groups`
--
ALTER TABLE `customer_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_group_sections`
--
ALTER TABLE `customer_group_sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flash_sell`
--
ALTER TABLE `flash_sell`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `header_block`
--
ALTER TABLE `header_block`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `help_centers`
--
ALTER TABLE `help_centers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `product_sections`
--
ALTER TABLE `product_sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_order_receives`
--
ALTER TABLE `purchase_order_receives`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_order_receive_items`
--
ALTER TABLE `purchase_order_receive_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_return_items`
--
ALTER TABLE `purchase_return_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_menus`
--
ALTER TABLE `user_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `user_menu_actions`
--
ALTER TABLE `user_menu_actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `verify_customers`
--
ALTER TABLE `verify_customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `zone`
--
ALTER TABLE `zone`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
