/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.27-MariaDB : Database - 19696_mohsin_ali_sahito
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`19696_mohsin_ali_sahito` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `19696_mohsin_ali_sahito`;

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `blog_title` varchar(25) DEFAULT NULL,
  `post_per_page` int(11) DEFAULT NULL,
  `blog_background_image` text DEFAULT NULL,
  `blog_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`blog_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `blog` */

insert  into `blog`(`blog_id`,`user_id`,`blog_title`,`post_per_page`,`blog_background_image`,`blog_status`,`created_at`,`updated_at`) values 
(1,2,'A.I ',5,'pexels-tara-winstead-8386440.jpg','Active','2023-05-23 23:35:16','2023-05-23 23:00:34'),
(2,2,'Space Exploration',10,'pexels-rodolfo-clix-1366942.jpg','Active','2023-05-24 09:52:25','2023-05-24 09:52:25'),
(3,2,'Hockey',10,'pexels-tony-schnagl-6468741.jpg','Active','2023-05-24 10:05:02',NULL);

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(100) DEFAULT NULL,
  `category_description` text DEFAULT NULL,
  `category_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `category` */

insert  into `category`(`category_id`,`category_title`,`category_description`,`category_status`,`created_at`,`updated_at`) values 
(1,'Technology','This category is about Technology','Active','2023-05-23 22:50:52',NULL),
(2,'Science','This category is about Science','Active','2023-05-23 23:57:25',NULL),
(3,'Sports','This category is for Sports','Active','2023-05-24 09:53:16','2023-05-24 09:53:09');

/*Table structure for table `following_blog` */

DROP TABLE IF EXISTS `following_blog`;

CREATE TABLE `following_blog` (
  `follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `follower_id` int(11) DEFAULT NULL,
  `blog_following_id` int(11) DEFAULT NULL,
  `status` enum('Followed','Unfollowed') DEFAULT 'Followed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`follow_id`),
  KEY `blog_following_id` (`blog_following_id`),
  KEY `follower_id` (`follower_id`),
  CONSTRAINT `following_blog_ibfk_1` FOREIGN KEY (`blog_following_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `following_blog_ibfk_2` FOREIGN KEY (`follower_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `following_blog` */

insert  into `following_blog`(`follow_id`,`follower_id`,`blog_following_id`,`status`,`created_at`,`updated_at`) values 
(1,2,1,'Followed','2023-05-23 23:17:41',NULL),
(2,3,1,'Followed','2023-05-23 23:54:20',NULL),
(3,2,3,'Followed','2023-05-24 00:37:08',NULL);

/*Table structure for table `post` */

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) DEFAULT NULL,
  `post_title` varchar(200) NOT NULL,
  `post_summary` text NOT NULL,
  `post_description` longtext NOT NULL,
  `featured_image` text DEFAULT NULL,
  `post_status` enum('Active','InActive') DEFAULT NULL,
  `is_comment_allowed` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post` */

insert  into `post`(`post_id`,`blog_id`,`post_title`,`post_summary`,`post_description`,`featured_image`,`post_status`,`is_comment_allowed`,`created_at`,`updated_at`) values 
(1,1,'Future of A.I','Embracing the Future: Unlocking the Boundless Potential of Artificial Intelligence','Introduction\r\n\r\nArtificial Intelligence (AI) has rapidly transformed various aspects of our lives, from the way we interact with technology to the industries that shape our world. As we gaze into the future, it becomes increasingly evident that AI will continue to redefine the boundaries of human innovation. From enhanced decision-making processes to revolutionary breakthroughs, the potential of AI seems boundless. In this blog post, we will explore some fascinating insights into the future of artificial intelligence and the transformative impact it is poised to have on our society.\r\n\r\n    AI and Automation\r\n\r\nOne of the most significant areas where AI will revolutionize the future is automation. With AI-powered machines and robots becoming more sophisticated, they will increasingly take over repetitive, mundane, and dangerous tasks, freeing up human potential for more creative and strategic endeavors. This will lead to increased productivity, efficiency, and cost-effectiveness across industries such as manufacturing, logistics, and healthcare.\r\n\r\n    Enhanced Decision-Making\r\n\r\nAI has the potential to revolutionize decision-making by providing intelligent insights and augmenting human judgment. Advanced algorithms can analyze vast amounts of data, detect patterns, and provide valuable recommendations to support decision-making processes across diverse domains. From medical diagnoses to financial investments, AI-driven decision support systems will empower individuals and organizations to make more informed and accurate choices.\r\n\r\n    Personalized Experiences\r\n\r\nIn the future, AI will play a pivotal role in delivering personalized experiences tailored to individual preferences. AI-powered virtual assistants, chatbots, and recommendation systems will understand our behaviors, preferences, and needs, allowing for more personalized interactions across various platforms. Whether its personalized healthcare, curated entertainment, or customized shopping experiences, AI will transform the way we engage with technology, making it more intuitive and human-centric.\r\n\r\n    Healthcare Revolution\r\n\r\nThe healthcare sector stands to benefit immensely from the integration of AI technologies. With advancements in machine learning and deep learning algorithms, AI can assist in early disease detection, drug discovery, and personalized treatment plans. AI-powered medical imaging systems can aid in more accurate diagnoses, reducing human error and improving patient outcomes. Moreover, AI will enable remote patient monitoring, telemedicine, and virtual healthcare, making quality healthcare accessible to remote areas and underserved populations.\r\n\r\n    Ethical and Responsible AI\r\n\r\nAs AI becomes increasingly pervasive, ensuring ethical and responsible development and deployment is of paramount importance. The future of AI hinges on building robust frameworks that prioritize transparency, fairness, and accountability. Addressing bias, privacy concerns, and the potential impact on employment are vital steps towards harnessing the full potential of AI while maintaining societal trust. Striking a delicate balance between innovation and ethical considerations will be critical for shaping a positive future powered by AI.\r\n\r\nConclusion\r\n\r\nThe future of artificial intelligence holds tremendous promise and potential. From automating mundane tasks to augmenting human decision-making, AI will transform various industries and revolutionize the way we live, work, and interact with technology. As we embark on this journey, it is crucial to prioritize responsible and ethical development to ensure that AI serves as a force for good in society. By embracing AIs capabilities and leveraging its power responsibly, we can shape a future where human potential is amplified, problems are solved more efficiently, and new frontiers are explored. The future is bright, and artificial intelligence is at the heart of it all.','pexels-irina-iriser-1209751.jpg','Active',1,'2023-05-23 23:11:08',NULL),
(2,2,' Exploring the Great Beyond','A Journey into Space Exploration','Introduction:\r\n\r\nSpace, the final frontier, has captivated the human imagination for centuries. The quest to explore the vast cosmos has led to extraordinary advancements in science, technology, and our understanding of the universe. In this blog page, we embark on a cosmic adventure to delve into the captivating world of space exploration. Join us as we unveil the wonders of the cosmos, the challenges of space travel, and the profound impact space exploration has on our lives and the future of humanity.\r\n\r\n    The History of Space Exploration:\r\n\r\nFrom the first humble steps into space to the grand achievements of today, the history of space exploration is rich with groundbreaking milestones. Explore the early space missions like Apollo 11 and Yuri Gagarins journey, which paved the way for human space exploration. Learn about significant missions, such as the Hubble Space Telescope and Voyager probes, that revolutionized our understanding of the universe and captured breathtaking images of distant celestial bodies.\r\n\r\n    The International Space Station (ISS):\r\n\r\nDiscover the International Space Station, a remarkable feat of human collaboration and engineering. Dive into the daily lives of astronauts aboard the ISS, as they conduct research, perform experiments, and push the boundaries of human endurance in microgravity. Understand the crucial role the ISS plays in studying long-term space habitation, human biology, and fostering international cooperation.\r\n\r\n    Unveiling the Mysteries of the Cosmos:\r\n\r\nSpace exploration allows us to unravel the mysteries of the cosmos and expand our knowledge of the universe. Delve into the awe-inspiring discoveries made by space telescopes like Hubble, Kepler, and James Webb Space Telescope (JWST), which unveil distant galaxies, exoplanets, and phenomena like black holes and supernovae. Explore the quest for life beyond Earth through missions like Mars rovers and the search for habitable exoplanets.\r\n\r\n    Challenges of Space Travel:\r\n\r\nSpace exploration is not without its challenges. Explore the harsh conditions of space and the physical and psychological toll it takes on astronauts. Learn about the technological advancements required for long-duration space travel, including life support systems, propulsion technologies, and radiation protection. Discuss the challenges of interplanetary travel, such as Mars colonization and potential future missions to other celestial bodies.\r\n\r\n    Space Entrepreneurship and Commercial Spaceflight:\r\n\r\nThe rise of private space companies has revolutionized the field of space exploration. Discover the efforts of companies like SpaceX, Blue Origin, and Virgin Galactic in democratizing access to space and driving innovation in rocket technology. Learn about commercial space tourism and its potential impact on space exploration and the future of human space travel.\r\n\r\n    Inspiring the Next Generation:\r\n\r\nSpace exploration has the power to inspire generations of future scientists, engineers, and explorers. Explore the educational initiatives and outreach programs that aim to ignite curiosity and foster interest in space science and exploration among young minds. Discuss the importance of STEM education in shaping the next generation of space explorers and innovators.\r\n\r\nConclusion:\r\n\r\nSpace exploration represents humanitys relentless pursuit of knowledge, pushing the boundaries of our understanding and expanding our horizons beyond Earth. It sparks our curiosity, fuels technological advancements, and ignites the imaginations of generations to come. As we venture into the great beyond, let us embrace the wonders of space exploration and the profound impact it has on our lives, our understanding of the universe, and our aspirations for the future of humanity.','pexels-philippe-donn-1169754.jpg','Active',1,'2023-05-24 00:08:20',NULL),
(3,3,'The Thrills and Chills of Hockey','A Passionate Journey on Ice','Introduction:\r\n\r\nHockey, a sport that blends skill, speed, and strategy, has captivated fans around the globe for generations. Whether played on frozen ponds or in state-of-the-art arenas, this exhilarating game brings communities together and ignites a fierce passion in players and spectators alike. In this blog page, we lace up our skates and dive into the world of hockey, exploring its rich history, electrifying gameplay, and the enduring love affair between fans and the sport.\r\n\r\n    The Origins and Evolution of Hockey:\r\n\r\nTrace the roots of hockey back to its earliest origins, from the icy ponds of Canada to the bustling arenas of today. Learn about the historical milestones, rule changes, and influential figures that have shaped the modern game. Explore the different variations of hockey played across the world, including ice hockey, field hockey, and ball hockey, each with its own unique characteristics and fervent followers.\r\n\r\n    The Intensity of the Game:\r\n\r\nDiscover the heart-pounding action and adrenaline-fueled moments that make hockey a spectacle on ice. From lightning-fast skating to precision stickhandling, explore the skills and techniques that players employ to outmaneuver opponents and score breathtaking goals. Delve into the physicality of the game, as players engage in strategic battles, body checks, and thrilling fights that ignite the crowd and test their mettle.\r\n\r\n    Legendary Players and Memorable Moments:\r\n\r\nUncover the tales of hockeys greatest players and the unforgettable moments that have etched themselves into the sports history. From Wayne Gretzkys scoring prowess to Bobby Orrs mesmerizing end-to-end rushes, relive the exploits of the icons who have left an indelible mark on the game. Explore legendary rivalries and epic playoff battles that have produced some of the most dramatic and memorable moments in sports.\r\n\r\n    The Global Impact of Hockey:\r\n\r\nHockey transcends borders, captivating fans in countries far and wide. Take a journey around the world and explore the passionate hockey cultures that exist beyond traditional strongholds. Discover the rise of international competitions, such as the Olympics and World Championships, which showcase the games diversity and bring nations together in friendly competition. Discuss the growth of womens hockey and the inspiring achievements of female players at the highest level.\r\n\r\n    The Role of Fans and Community:\r\n\r\nHockey is more than just a game; it is a way of life for many devoted fans. Explore the unique bond between fans and their favorite teams, experiencing the electric atmosphere of packed arenas and the roar of the crowd. Dive into the traditions, rituals, and superstitions that unite fans in their unwavering support. Discuss the importance of grassroots hockey in nurturing young talent and fostering a sense of community pride.\r\n\r\n    Hockey Beyond the Ice:\r\n\r\nHockeys impact extends far beyond the rink. Explore the charitable initiatives, outreach programs, and community involvement efforts undertaken by players, teams, and organizations. Discover how hockey inspires and empowers individuals, promotes inclusivity, and creates positive change in society.\r\n\r\nConclusion:\r\n\r\nHockey is more than just a sport; it is a source of joy, camaraderie, and excitement that captivates fans across the globe. From the intensity of the gameplay to the rich traditions and inspiring stories, hockey weaves a tapestry of emotions and memories. As we celebrate the exhilarating world of hockey, let us embrace the passion and unity it fosters, while recognizing the profound impact it has on players, communities, and the lives of fans who share in its love.','pexels-pixabay-38551.jpg','Active',0,'2023-05-24 00:27:51',NULL),
(4,2,'Beyond Earth: The Next Frontier','Exploring the Prospects of Space Colonization','Introduction:\r\n\r\nThroughout history, humanity has always sought to expand its horizons and venture into the unknown. Today, the concept of space colonization has become an exciting topic, captivating the imagination of scientists, dreamers, and visionaries alike. In this blog page, we embark on a cosmic journey to explore the possibilities and challenges of space colonization. From envisioning future habitats on distant celestial bodies to contemplating the impact on our civilization, join us as we delve into the frontiers of space colonization.\r\n\r\n    The Drive for Space Colonization:\r\n\r\nUnderstand the motivations behind space colonization and why it has captured the interest of scientists, engineers, and space enthusiasts. Discuss the desire to establish a backup for humanity, safeguarding against potential existential threats on Earth. Explore the scientific and economic incentives, such as resource exploitation and the expansion of scientific knowledge, driving the quest for space colonization.\r\n\r\n    The Potential Colonization Destinations:\r\n\r\nDelve into the potential celestial bodies that could serve as future homes for humanity. From our closest neighbor, the Moon, to Mars and beyond, examine the possibilities and challenges associated with each destination. Discuss the factors that make these celestial bodies attractive for colonization, such as proximity, availability of resources, and potential for terraforming.\r\n\r\n    Establishing Habitats in Space:\r\n\r\nImagine the architecture and infrastructure required to support sustainable human habitats in space. Explore concepts such as space stations, lunar bases, and Martian settlements, each presenting unique challenges and innovative solutions. Discuss the development of self-sustaining ecosystems, life support systems, and advancements in space farming to ensure the long-term viability of these habitats.\r\n\r\n    Technological Advancements for Space Colonization:\r\n\r\nExamine the technological breakthroughs needed to make space colonization a reality. Discuss advancements in propulsion systems, spacecraft design, and interplanetary transportation. Explore emerging technologies such as 3D printing, robotics, and artificial intelligence that could revolutionize the construction and maintenance of space colonies.\r\n\r\n    Challenges and Risks:\r\n\r\nSpace colonization is not without its challenges and risks. Discuss the physical and psychological effects of long-duration space travel on astronauts. Examine the difficulties of resource utilization, including energy production, water extraction, and food cultivation in extraterrestrial environments. Address the potential health risks posed by cosmic radiation and the need for effective radiation shielding. Consider the ethical implications of colonizing celestial bodies that may harbor indigenous life.\r\n\r\n    The Societal Impact:\r\n\r\nReflect on the broader implications of space colonization for our civilization. Discuss the potential for international cooperation and collaboration in realizing ambitious space colonization projects. Explore the social, cultural, and economic changes that may arise from a multi-planetary society. Consider the philosophical and ethical questions surrounding our responsibility to preserve the integrity of other celestial bodies and the potential for human expansion beyond our solar system.\r\n\r\nConclusion:\r\n\r\nSpace colonization represents a bold vision for the future of humanity, pushing the boundaries of exploration and our place in the cosmos. As we venture into the realms of space colonization, we must address the technical, logistical, and ethical challenges that lie ahead. Through interdisciplinary collaboration, technological advancements, and a collective drive for discovery, we can lay the groundwork for a future where our species reaches for the stars and finds new homes among the vast expanse of the universe. The adventure of space colonization beckons, and it is up to us to take the first steps towards this grand endeavor.','pexels-pixabay-220201.jpg','Active',1,'2023-05-24 10:32:16','2023-05-24 10:32:16');

/*Table structure for table `post_atachment` */

DROP TABLE IF EXISTS `post_atachment`;

CREATE TABLE `post_atachment` (
  `post_atachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `post_attachment_title` varchar(200) DEFAULT NULL,
  `post_attachment_path` text DEFAULT NULL,
  `is_active` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_atachment_id`),
  KEY `fk1` (`post_id`),
  CONSTRAINT `fk1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_atachment` */

insert  into `post_atachment`(`post_atachment_id`,`post_id`,`post_attachment_title`,`post_attachment_path`,`is_active`,`created_at`,`updated_at`) values 
(1,1,'Attachment-1592279132','','InActive','2023-05-23 23:17:14',NULL),
(2,2,'Attachment-112582925','','InActive','2023-05-24 00:09:16',NULL),
(3,3,'Attachment-1581554666','','InActive','2023-05-24 10:05:21',NULL),
(6,4,'Attachment-2046763034','logo2.jpg','Active','2023-05-24 10:37:31',NULL),
(7,4,'Attachment-20567428','logo4.png','Active','2023-05-24 10:37:38',NULL);

/*Table structure for table `post_category` */

DROP TABLE IF EXISTS `post_category`;

CREATE TABLE `post_category` (
  `post_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_category_id`),
  KEY `post_id` (`post_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_category` */

insert  into `post_category`(`post_category_id`,`post_id`,`category_id`,`created_at`,`updated_at`) values 
(1,1,1,'2023-05-23 23:11:08',NULL),
(2,2,2,'2023-05-24 00:08:20',NULL),
(3,3,3,'2023-05-24 00:27:51',NULL),
(4,4,2,'2023-05-24 10:32:17','2023-05-24 10:32:16');

/*Table structure for table `post_comment` */

DROP TABLE IF EXISTS `post_comment`;

CREATE TABLE `post_comment` (
  `post_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_active` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`post_comment_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `post_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_comment` */

insert  into `post_comment`(`post_comment_id`,`post_id`,`user_id`,`comment`,`is_active`,`created_at`) values 
(1,1,2,'Nice Post!','Active','2023-05-24 09:52:40');

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_type` varchar(50) NOT NULL,
  `is_active` enum('Active','InActive') DEFAULT 'Active',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `role` */

insert  into `role`(`role_id`,`role_type`,`is_active`) values 
(1,'Admin','Active'),
(2,'User','Active');

/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `setting_key` varchar(100) DEFAULT NULL,
  `setting_value` varchar(100) DEFAULT NULL,
  `setting_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`setting_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `setting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `setting` */

insert  into `setting`(`setting_id`,`user_id`,`setting_key`,`setting_value`,`setting_status`,`created_at`,`updated_at`) values 
(1,2,'color','indigo','Active','2023-05-24 00:45:20',NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` text NOT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `user_image` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_approved` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `is_active` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`user_id`,`role_id`,`first_name`,`last_name`,`email`,`password`,`gender`,`date_of_birth`,`user_image`,`address`,`is_approved`,`is_active`,`created_at`,`updated_at`) values 
(2,1,'Mohsin','Sahito','hist6782@gmail.com','admin05@','Male','2000-03-01','admin.jpg','Jamshoro, Hyderabad','Approved','Active','2023-05-23 22:40:46','2023-05-23 22:40:46'),
(3,2,'Gaffar','Sahito','abc1@gmail.com','qwerty1@','Male','2023-05-01','pexels-photo-1040880.jpeg','Here','Approved','Active','2023-05-23 23:39:09','2023-05-23 23:39:09'),
(4,2,'Ahsan','Khan','abc2@gmail.com','qwerty1@','Male','2023-05-01','pexels-photo-10909251.jpeg','There','Approved','Active','2023-05-23 23:40:08','2023-05-23 23:39:19'),
(5,2,'Toheed','Khan','abc3@gmail.com','73339556','Male','2023-05-01','people-peoples-homeless-male.jpg','Nowhere','Pending',NULL,'2023-05-24 09:46:29',NULL);

/*Table structure for table `user_feedback` */

DROP TABLE IF EXISTS `user_feedback`;

CREATE TABLE `user_feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`feedback_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user_feedback` */

insert  into `user_feedback`(`feedback_id`,`user_id`,`user_name`,`user_email`,`feedback`,`created_at`,`updated_at`) values 
(1,2,'Mohsin','mohsinalisahito7@gmail.com','Keep it up','2023-05-23 20:21:51',NULL),
(2,2,'Mohsin','mohsinalisahito7@gmail.com','Good work','2023-05-23 20:24:24',NULL),
(3,2,'Mohsin','mohsinalisahito7@gmail.com','Nice Blog','2023-05-24 07:41:42',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
