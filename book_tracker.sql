-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 31, 2025 at 08:40 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `bio` text,
  `birth_year` smallint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `bio`, `birth_year`) VALUES
(1, 'Frank Herbert', 'American science fiction writer, best known for the \"Dune\" series, blending politics, ecology, religion, and human behavior into epic storytelling.', 1920),
(2, 'George Orwell', 'English novelist and essayist, author of \"1984\" and \"Animal Farm\", exploring totalitarianism, politics, and social injustice with enduring relevance.', 1903),
(3, 'Jane Austen', 'English novelist known for \"Pride and Prejudice\" and \"Sense and Sensibility\", writing romantic fiction with social commentary in the Georgian era.', 1775),
(4, 'J.R.R. Tolkien', 'English writer, poet, and philologist, author of \"The Lord of the Rings\" and \"The Hobbit\", creator of Middle-earth and modern high fantasy.', 1892),
(5, 'Harper Lee', 'American novelist, famous for \"To Kill a Mockingbird\", exploring racial injustice, morality, and childhood in the American South.', 1926),
(6, 'J.D. Salinger', 'American writer, known for \"The Catcher in the Rye\" and other works exploring adolescence, alienation, and post-war American life.', 1919),
(7, 'F. Scott Fitzgerald', 'American novelist and short story writer, prominent figure of the Jazz Age, famous for \"The Great Gatsby\", exploring wealth, love, and the American dream.', 1896),
(8, 'Yuval Noah Harari', 'Israeli historian and philosopher, known for books like \"Sapiens\", examining human history, evolution, culture, and society in engaging prose.', 1948),
(9, 'Patrick Rothfuss', 'American fantasy writer, author of \"The Kingkiller Chronicle\", celebrated for lyrical prose and immersive storytelling.', 1973),
(10, 'Tara Westover', 'American memoirist and author of \"Educated\", a memoir about growing up in a strict household and pursuing education despite obstacles.', 1978),
(11, 'Neil Gaiman', 'English author of fantasy, graphic novels, and short stories, known for works such as \"Coraline\" and \"American Gods\", blending myth, folklore, and modern life.', 1948),
(12, 'Terry Pratchett', 'English author of fantasy, satire, and children’s novels, creator of the Discworld series, blending humor with imaginative world-building.', 1948),
(13, 'Isaac Asimov', 'Russian-born American science fiction writer and biochemist, author of the Foundation series, prolific in popular science and speculative fiction.', 1920),
(14, 'Margaret Atwood', 'Canadian poet, novelist, literary critic, and essayist, author of \"The Handmaid\'s Tale\" and other speculative fiction exploring society and gender.', 1939),
(16, 'Stephen King', 'American author of horror, supernatural fiction, suspense, and fantasy, known for prolific output and works like \"The Shining\" and \"It\".', 1947),
(17, 'Agatha Christie', 'English novelist, famous for her detective fiction featuring Hercule Poirot and Miss Marple, considered the Queen of Mystery.', 1890),
(18, 'Dan Brown', 'American author of thriller novels including \"The Da Vinci Code\", blending art, history, symbols, and cryptography into fast-paced suspense stories.', 1964),
(19, 'Suzanne Collins', 'American television writer and author, best known for \"The Hunger Games\" series, exploring dystopia, politics, and survival.', 1962),
(20, 'Veronica Roth', 'American young adult author, best known for the Divergent trilogy, exploring dystopian societies, identity, and personal choice.', 1988),
(21, 'John Green', 'American author, vlogger, and educator, known for contemporary novels such as \"The Fault in Our Stars\" blending humor, romance, and social themes.', 1977),
(22, 'Leo Tolstoy', 'Russian author and philosopher, famous for \"War and Peace\" and \"Anna Karenina\", exploring morality, society, and human experience in epic novels.', 1828),
(23, 'Charles Dickens', 'English novelist and social critic, famous for works such as \"Great Expectations\" and \"Oliver Twist\", highlighting social injustice and Victorian life.', 1812),
(24, 'H.G. Wells', 'English writer, futurist, and social commentator, pioneer of science fiction with works like \"The Time Machine\" and \"The War of the Worlds\".', 1866),
(25, 'Mark Twain', 'American writer, humorist, and lecturer, famous for \"Adventures of Huckleberry Finn\" and \"The Adventures of Tom Sawyer\", critical of society and politics.', 1835),
(26, 'George R.R. Martin', 'American novelist and short story writer, creator of \"A Song of Ice and Fire\", known for complex characters, political intrigue, and epic fantasy.', 1948),
(27, 'C.S. Lewis', 'British novelist and scholar, known for \"The Chronicles of Narnia\" series and Christian apologetics, blending imaginative storytelling with philosophical themes.', 1898),
(28, 'Philip K. Dick', 'American writer, known for science fiction novels exploring identity, reality, and consciousness in works like \"Do Androids Dream of Electric Sheep?\"', 1928),
(29, 'Arthur C. Clarke', 'British science fiction writer, futurist, and inventor, co-wrote \"2001: A Space Odyssey\", renowned for visionary depictions of space and technology.', 1917),
(30, 'Ernest Hemingway', 'American novelist, short story writer, and journalist, famous for works such as \"The Old Man and the Sea\" and \"A Farewell to Arms\", style known for brevity.', 1899),
(31, 'Aldous Huxley', 'English writer and philosopher, best known for his dystopian novel \"Brave New World\" exploring futuristic society, technology, and human conditioning.', 1894),
(32, 'Ray Bradbury', 'American author and screenwriter, famous for \"Fahrenheit 451\" and \"The Martian Chronicles\", blending science fiction with social critique.', 1920),
(33, 'Daniel Kahneman', 'Israeli-American psychologist and Nobel laureate, known for research on decision-making, heuristics, and behavioral economics, author of \"Thinking, Fast and Slow\".', 1934),
(34, 'Charles Duhigg', 'American journalist and author of \"The Power of Habit\", exploring psychology, habits, and productivity with engaging real-world examples.', 1974),
(35, 'Herman Melville', 'American novelist, short story writer, and poet, best known for \"Moby-Dick\", exploring obsession, humanity, and the sea in epic prose.', 1819),
(36, 'Carl Sagan', 'American astronomer, astrophysicist, and author, known for popularizing science through books like \"Cosmos\" and promoting understanding of the universe.', 1934),
(37, 'Cormac McCarthy', 'American novelist, known for dark, sparse prose in novels like \"The Road\" and \"No Country for Old Men\", exploring violence, survival, and human nature.', 1933),
(38, 'Rebecca Skloot', 'American science writer, author of \"The Immortal Life of Henrietta Lacks\", exploring medical ethics, history, and science in compelling narrative.', 1972),
(39, 'Haruki Murakami', 'Japanese novelist and translator, known for blending magical realism with contemporary life in novels like \"Norwegian Wood\" and \"Kafka on the Shore\".', 1949),
(40, 'Stieg Larsson', 'Swedish journalist and writer, famous for the Millennium trilogy, exposing crime, corruption, and societal issues in Sweden.', 1959),
(41, 'Alex Michaelides', 'British-Cypriot author and screenwriter, gained fame with his psychological thriller debut novel \"The Silent Patient\", blending suspense with emotional depth.', 1970),
(42, 'Bill Bryson', 'American-British author, famous for humorous books on travel, language, and science including \"A Short History of Nearly Everything\", combining wit with insight.', 1951),
(43, 'David McCullough', 'American author, narrator, and historian, wrote acclaimed biographies and histories, including works on Truman and John Adams, celebrated for narrative style.', 1933),
(44, 'Karen Blixen', 'Danish author, famously known by her pen name Isak Dinesen, who is best known for her memoir Out of Africa. She is also celebrated for her short stories, such as Babette\'s Feast, and novels like Seven Gothic Tales.', 1885),
(45, 'Klaus Rifbjerg', 'His breakthrough was in 1958 with the novel \"Den kroniske Uskyld\" It was made into a film in 1985, directed by Edward Fleming. From that time on he published more than 100 novels as well as poetry and short story collections, plays, TV and radio plays, film scripts, children\'s books and diaries.', 1931),
(47, 'Socrates', 'Greek philosopher known for the Socratic method of questioning and for laying the foundation of Western philosophy. He is famous for focusing on ethics and how to live a moral life, rather than on scientific or cosmological questions.', -470),
(50, 'Plato', 'Ancient Greek philosopher, a student of Socrates, and the teacher of Aristotle. He founded the Academy in Athens, one of the earliest institutions of higher learning, and wrote extensively on a wide range of subjects, including metaphysics, epistemology, and politics.', -428);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` int DEFAULT NULL,
  `description` text,
  `pages` int DEFAULT NULL,
  `frontpage_img` varchar(255) DEFAULT NULL,
  `main_genre_id` int DEFAULT NULL,
  `status_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `year`, `description`, `pages`, `frontpage_img`, `main_genre_id`, `status_id`) VALUES
(4, 'Dune', 1965, 'Epic science fiction novel set on the desert planet Arrakis, following Paul Atreides as he becomes embroiled in political intrigue and prophecy.', 412, 'https://m.media-amazon.com/images/I/81Ua99CURsL._AC_UF1000,1000_QL80_.jpg', 3, 2),
(5, '1984', 1949, 'A dystopian classic depicting a totalitarian society under constant surveillance, exploring the dangers of authoritarianism and thought control.', 328, 'https://images.booksense.com/images/333/869/9781328869333.jpg', 11, 1),
(6, 'Pride and Prejudice', 1813, 'Jane Austen’s timeless romance exploring love, class, and misunderstandings in early 19th-century England.', 279, 'https://imgcdn.saxo.com/_9781441341709', 9, 3),
(7, 'The Hobbit', 1937, 'Bilbo Baggins, a reluctant hobbit, embarks on a dangerous journey with dwarves to reclaim their mountain home from a dragon.', 310, 'https://imgcdn.saxo.com/_9780261103344', 4, 3),
(8, 'To Kill a Mockingbird', 1960, 'Harper Lee’s classic tale of racial injustice and moral growth in the American South, seen through the eyes of young Scout Finch.', 336, 'https://cdn.kobo.com/book-images/b8121c19-4eeb-4e75-be4c-cfeb81b16a9b/353/569/90/False/to-kill-a-mockingbird-3.jpg', 1, 3),
(9, 'The Catcher in the Rye', 1951, 'Holden Caulfield recounts his alienation and disillusionment in postwar New York, a defining work of modern American fiction.', 277, 'https://m.media-amazon.com/images/I/8125BDk3l9L._AC_UF1000,1000_QL80_.jpg', 1, 1),
(10, 'The Great Gatsby', 1925, 'F. Scott Fitzgerald’s portrait of the Roaring Twenties, exploring love, wealth, and the American Dream through the tragic figure of Jay Gatsby.', 180, 'https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1650033243i/41733839.jpg', 1, 3),
(11, 'Sapiens: A Brief History of Humankind', 2011, 'Yuval Noah Harari explores the evolution of Homo sapiens, tracing how biology and history have shaped our societies and beliefs.', 498, 'https://www.penguinrandomhouse.co.za/sites/penguinbooks.co.za/files/cover/9781529913934.jpg', 25, 2),
(12, 'The Name of the Wind', 2007, 'Patrick Rothfuss’ lyrical fantasy follows Kvothe, a gifted musician and magician, as he recounts his rise to legend.', 662, 'https://grimoakpress.com/cdn/shop/files/cover-notw-fc.jpg?v=1706902909', 4, 2),
(13, 'Educated', 2018, 'Tara Westover’s memoir of growing up in a strict, survivalist family in rural Idaho, and her journey toward education and independence.', 334, 'https://imgcdn.saxo.com/_9780399590504', 22, 3),
(14, 'Good Omens', 1990, 'A comedic apocalyptic story of an angel and demon teaming up to prevent the end of the world.', 432, 'https://images.faraos.dk/ItemImages/9780060853976/medium/9780060853976.jpg', 4, 2),
(15, 'American Gods', 2001, 'Shadow, a man caught between myth and reality, becomes embroiled in a battle of old and new gods.', 600, 'https://www.neilgaiman.com/works/images/AmericanGods_Watercolor_TradePaperback_1629509646.jpg', 3, 1),
(16, 'Foundation', 1951, 'A complex saga of humans scattered across the galaxy, dealing with the collapse and rebirth of civilizations.', 255, 'https://atboundarysedge.com/wp-content/uploads/2020/08/foundation.jpg', 3, 2),
(17, 'The Handmaid\'s Tale', 1985, 'A dystopian society where women are forced into reproductive servitude.', 311, 'https://m.media-amazon.com/images/I/61su39k8NUL._AC_UF1000,1000_QL80_.jpg', 11, 3),
(19, 'The Shining', 1977, 'A family moves into an isolated hotel with a violent supernatural presence, leading to psychological terror.', 447, 'https://imgcdn.saxo.com/_9780345806789', 8, 1),
(20, 'Murder on the Orient Express', 1934, 'Detective Hercule Poirot investigates a murder aboard a luxurious train, uncovering hidden motives among passengers.', 256, 'https://m.media-amazon.com/images/I/81aY+Fk-g8L._UF1000,1000_QL80_.jpg', 7, 3),
(21, 'The Da Vinci Code', 2003, 'A symbologist uncovers secrets hidden in Leonardo da Vinci\'s works, leading to a thrilling global conspiracy.', 454, 'https://cdn.penguin.co.uk/dam-assets/books/9780552159715/9780552159715-jacket-large.jpg', 5, 2),
(22, 'The Hunger Games', 2008, 'Katniss Everdeen participates in a televised fight-to-the-death arena to survive and protect her family.', 374, 'https://covers.shakespeareandcompany.com/97814071/9781407132082.jpg', 11, 3),
(23, 'Divergent', 2011, 'In a dystopian society divided by personality factions, Tris must discover who she truly is.', 487, 'https://www.slovart.cz/buxus/images/image_23010_19_v1.jpeg', 11, 2),
(24, 'A Game of Thrones', 1996, 'Noble families vie for control of the Iron Throne in a sprawling epic fantasy.', 694, 'https://cdn1.bookmanager.com/i/m?b=OFG34itBLfBWQiu1ESEmew&cb=1755663502', 4, 2),
(25, 'The Lion, the Witch and the Wardrobe', 1950, 'Four children discover a magical land ruled by the evil White Witch.', 208, 'https://mir-s3-cdn-cf.behance.net/project_modules/hd/a0c39048873339.58a470c427a06.jpg', 4, 3),
(26, 'Do Androids Dream of Electric Sheep?', 1968, 'In a post-apocalyptic future, bounty hunter Rick Deckard hunts rogue androids.', 210, 'https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1447604654i/27778619.jpg', 3, 1),
(27, 'The War of the Worlds', 1898, 'An alien invasion threatens Earth, narrated through the lens of human survival and ingenuity.', 192, 'https://d1btptoiso7inb.cloudfront.net/OEzFmsvEClgrWX0HFXYBRXRqdA_b11TTwmvyOL4ovyU/s:540:776/aHR0cHM6Ly9ib29r/ZnVzaW9uLnMzLmFt/YXpvbmF3cy5jb20v/Ym9vay9jb3Zlci8w/MDAvMTM3LzIxNS8y/NDI0MzA2MmIzYzdj/MzBjLmpwZw', 3, 2),
(28, 'Anna Karenina', 1877, 'A tragic tale of love, infidelity, and Russian society.', 864, 'https://res.cloudinary.com/bloomsbury-atlas/image/upload/w_568,c_scale,dpr_1.5/jackets/9781847493682.jpg', 1, 3),
(29, 'Great Expectations', 1861, 'The rise and fall of Pip, an orphan navigating wealth, love, and social class in Victorian England.', 505, 'https://covers.shakespeareandcompany.com/97814351/9781435172616.jpg', 1, 2),
(30, 'On Writing: A Memoir of the Craft', 2000, 'Stephen King shares his personal story and advice for aspiring writers.', 288, 'https://rep.club/cdn/shop/products/9781982159375.jpg?v=1658416822', 29, 3),
(32, 'The Diary of a Young Girl', 1947, 'Anne Frank\'s diary recounting her life in hiding during the Nazi occupation of the Netherlands.', 283, 'https://images.penguinrandomhouse.com/cover/9780385480338', 22, 3),
(33, 'The Old Man and the Sea', 1952, 'An aging fisherman struggles to catch a giant marlin in the Gulf Stream.', 127, 'https://cdn2.penguin.com.au/covers/original/9780099273967.jpg', 1, 1),
(34, 'The Fellowship of the Ring', 1954, 'The first volume of The Lord of the Rings, following Frodo as he begins his quest to destroy the One Ring.', 423, 'https://m.media-amazon.com/images/I/71Ep7UNeTtL._AC_UF1000,1000_QL80_.jpg', 4, 2),
(35, 'The Two Towers', 1954, 'The second volume of The Lord of the Rings, chronicling the battles and journeys of the fellowship.', 352, 'https://m.media-amazon.com/images/I/71nNxfSvGnL._UF1000,1000_QL80_.jpg', 4, 2),
(36, 'The Return of the King', 1955, 'The final volume of The Lord of the Rings, concluding the epic struggle against Sauron.', 416, 'https://m.media-amazon.com/images/I/71tDovoHA+L._AC_UF1000,1000_QL80_.jpg', 4, 1),
(37, 'Brave New World', 1932, 'A futuristic dystopian society is explored, showing the dangers of a controlled and technologically advanced society.', 311, 'https://dynamic.indigoimages.ca/v1/books/books/0061767646/1.jpg?width=810&maxHeight=810&quality=85', 11, 1),
(38, 'Fahrenheit 451', 1953, 'In a society where books are banned, a fireman begins to question the system and seeks knowledge.', 249, 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781451673265/fahrenheit-451-9781451673265_lg.jpg', 11, 2),
(39, 'Thinking, Fast and Slow', 2011, 'Daniel Kahneman explores human thinking, biases, and decision-making.', 499, 'https://cdn.penguin.co.in/wp-content/uploads/2025/06/9781802063059-1-scaled.jpg', 29, 3),
(40, 'The Power of Habit', 2012, 'Explains how habits are formed and how to change them for personal and professional improvement.', 371, 'https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1366562921i/17248798.jpg', 29, 2),
(41, 'Moby-Dick', 1851, 'Captain Ahab obsessively hunts the white whale Moby Dick across the oceans.', 635, 'https://www.williamdam.dk/products/4490101/moby-dick.jpg', 1, 1),
(42, 'War and Peace', 1869, 'Epic novel depicting Russian society during the Napoleonic wars.', 1225, 'https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1686602284i/177106015.jpg', 1, 2),
(43, 'Cosmos', 1980, 'Carl Sagan explores the universe, science, and humanity\'s place within it.', 384, 'https://pictures.abebooks.com/isbn/9780517123553-uk.jpg', 26, 3),
(44, 'The Road', 2006, 'A father and son struggle to survive in a post-apocalyptic world.', 287, 'https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1600241424i/6288.jpg', 11, 1),
(45, 'The Immortal Life of Henrietta Lacks', 2010, 'The story of the woman whose cells were used for scientific research without her knowledge.', 370, 'https://m.media-amazon.com/images/I/81CvDTTlxDL._AC_UF894,1000_QL80_.jpg', 25, 2),
(46, 'Norwegian Wood', 1987, 'A nostalgic story of loss and sexuality in 1960s Tokyo.', 296, 'https://imgcdn.saxo.com/_9780099448822', 12, 3),
(47, 'The Girl with the Dragon Tattoo', 2005, 'A journalist and hacker investigate a wealthy family\'s dark secrets.', 465, 'https://m.media-amazon.com/images/I/71-ICZM7B4L._AC_UF1000,1000_QL80_.jpg', 6, 2),
(48, 'The Silent Patient', 2019, 'A woman stops speaking after committing a violent act, and a therapist investigates.', 336, 'https://imusic.b-cdn.net/images/item/original/481/9781250762481.jpg?alex-michaelides-2020-the-silent-patient-paperback-bog&class=scaled&v=1623395191', 8, 1),
(50, 'The Wright Brothers', 2015, 'Biography of Orville and Wilbur Wright, pioneers of flight.', 320, 'https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1430942575i/22609391.jpg', 25, 2),
(51, 'A Short History of Nearly Everything', 2003, 'Bill Bryson explains science in a humorous and accessible way.', 560, 'https://m.media-amazon.com/images/I/71yt6mN5HuL._AC_UF1000,1000_QL80_.jpg', 25, 3);

-- --------------------------------------------------------

--
-- Table structure for table `books_backup`
--

CREATE TABLE `books_backup` (
  `id` int NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `description` text,
  `pages` int DEFAULT NULL,
  `frontpage_img` varchar(255) DEFAULT NULL,
  `main_genre_id` int DEFAULT NULL,
  `status_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books_backup`
--

INSERT INTO `books_backup` (`id`, `title`, `description`, `pages`, `frontpage_img`, `main_genre_id`, `status_id`) VALUES
(4, 'Dune', 'Epic science fiction novel set on the desert planet Arrakis, following Paul Atreides as he becomes embroiled in political intrigue and prophecy.', 412, '', 3, 2),
(5, '1984', 'A dystopian classic depicting a totalitarian society under constant surveillance, exploring the dangers of authoritarianism and thought control.', 328, '', 11, 1),
(6, 'Pride and Prejudice', 'Jane Austen’s timeless romance exploring love, class, and misunderstandings in early 19th-century England.', 279, '', 9, 3),
(7, 'The Hobbit', 'Bilbo Baggins, a reluctant hobbit, embarks on a dangerous journey with dwarves to reclaim their mountain home from a dragon.', 310, '', 4, 3),
(8, 'To Kill a Mockingbird', 'Harper Lee’s classic tale of racial injustice and moral growth in the American South, seen through the eyes of young Scout Finch.', 336, '', 1, 3),
(9, 'The Catcher in the Rye', 'Holden Caulfield recounts his alienation and disillusionment in postwar New York, a defining work of modern American fiction.', 277, '', 1, 1),
(10, 'The Great Gatsby', 'F. Scott Fitzgerald’s portrait of the Roaring Twenties, exploring love, wealth, and the American Dream through the tragic figure of Jay Gatsby.', 180, '', 1, 3),
(11, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari explores the evolution of Homo sapiens, tracing how biology and history have shaped our societies and beliefs.', 498, '', 25, 2),
(12, 'The Name of the Wind', 'Patrick Rothfuss’ lyrical fantasy follows Kvothe, a gifted musician and magician, as he recounts his rise to legend.', 662, '', 4, 2),
(13, 'Educated', 'Tara Westover’s memoir of growing up in a strict, survivalist family in rural Idaho, and her journey toward education and independence.', 334, '', 22, 3);

-- --------------------------------------------------------

--
-- Table structure for table `book_authors`
--

CREATE TABLE `book_authors` (
  `book_id` int NOT NULL,
  `author_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_authors`
--

INSERT INTO `book_authors` (`book_id`, `author_id`) VALUES
(4, 1),
(5, 2),
(6, 3),
(7, 4),
(34, 4),
(35, 4),
(36, 4),
(8, 5),
(9, 6),
(10, 7),
(11, 8),
(12, 9),
(50, 9),
(13, 10),
(14, 11),
(15, 11),
(14, 12),
(16, 13),
(17, 14),
(19, 16),
(30, 16),
(20, 17),
(21, 18),
(22, 19),
(23, 20),
(28, 22),
(42, 22),
(29, 23),
(27, 24),
(24, 26),
(25, 27),
(26, 28),
(32, 29),
(40, 29),
(33, 30),
(37, 31),
(38, 32),
(39, 33),
(40, 34),
(41, 35),
(43, 36),
(44, 37),
(45, 38),
(46, 39),
(47, 40),
(48, 41),
(51, 42);

-- --------------------------------------------------------

--
-- Table structure for table `book_genres`
--

CREATE TABLE `book_genres` (
  `book_id` int NOT NULL,
  `genre_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_genres`
--

INSERT INTO `book_genres` (`book_id`, `genre_id`) VALUES
(6, 1),
(46, 1),
(8, 2),
(10, 2),
(28, 2),
(29, 2),
(42, 2),
(5, 3),
(22, 3),
(37, 3),
(38, 3),
(44, 3),
(19, 5),
(20, 5),
(19, 6),
(21, 6),
(47, 7),
(28, 9),
(4, 10),
(7, 10),
(12, 10),
(14, 10),
(16, 10),
(24, 10),
(25, 10),
(27, 10),
(34, 10),
(35, 10),
(36, 10),
(50, 10),
(15, 11),
(26, 11),
(47, 11),
(9, 13),
(7, 14),
(9, 14),
(12, 14),
(22, 14),
(23, 14),
(25, 14),
(6, 18),
(10, 18),
(14, 18),
(15, 18),
(29, 18),
(38, 18),
(48, 18),
(30, 22),
(42, 22),
(45, 22),
(46, 22),
(13, 25),
(32, 25),
(42, 25),
(43, 25),
(11, 26),
(51, 26),
(11, 27),
(26, 27),
(39, 28),
(40, 28),
(13, 29),
(4, 33),
(5, 33),
(8, 33),
(17, 33),
(21, 33),
(24, 33);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(10, 'Adventure'),
(36, 'Art & Photography'),
(23, 'Autobiography'),
(21, 'Biography'),
(34, 'Business & Economics'),
(13, 'Contemporary Fiction'),
(7, 'Crime'),
(11, 'Dystopian'),
(35, 'Education'),
(39, 'Essays'),
(4, 'Fantasy'),
(37, 'Food & Cooking'),
(16, 'Graphic Novel'),
(30, 'Health & Fitness'),
(2, 'Historical Fiction'),
(25, 'History'),
(8, 'Horror'),
(1, 'Literary Fiction'),
(12, 'Magical Realism'),
(22, 'Memoir'),
(5, 'Mystery'),
(15, 'New Adult'),
(38, 'Parenting & Family'),
(27, 'Philosophy'),
(40, 'Poetry'),
(33, 'Politics'),
(28, 'Psychology'),
(32, 'Religion & Spirituality'),
(9, 'Romance'),
(18, 'Satire'),
(26, 'Science'),
(3, 'Science Fiction'),
(29, 'Self-Help'),
(17, 'Short Story'),
(6, 'Thriller'),
(31, 'Travel'),
(24, 'True Crime'),
(19, 'Urban Fiction'),
(20, 'Western'),
(14, 'Young Adult');

-- --------------------------------------------------------

--
-- Table structure for table `reading_status`
--

CREATE TABLE `reading_status` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reading_status`
--

INSERT INTO `reading_status` (`id`, `name`) VALUES
(4, 'Abandoned'),
(3, 'Completed'),
(5, 'On Hold'),
(1, 'Planned'),
(2, 'Reading');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` enum('editor','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `token`) VALUES
(5, 'editor', 'EDITOR_TOKEN_123'),
(6, 'admin', 'ADMIN_TOKEN_456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_genre_id` (`main_genre_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD PRIMARY KEY (`book_id`,`author_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `book_genres`
--
ALTER TABLE `book_genres`
  ADD PRIMARY KEY (`book_id`,`genre_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `reading_status`
--
ALTER TABLE `reading_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `token` (`token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `reading_status`
--
ALTER TABLE `reading_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`main_genre_id`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `reading_status` (`id`);

--
-- Constraints for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD CONSTRAINT `book_authors_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_authors_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `book_genres`
--
ALTER TABLE `book_genres`
  ADD CONSTRAINT `book_genres_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_genres_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
