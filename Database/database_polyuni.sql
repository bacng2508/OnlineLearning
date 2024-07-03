-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 07:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `da1_fakedata`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_status` varchar(50) NOT NULL DEFAULT '1' COMMENT '1: Hiển thị danh mục; 2: Ẩn danh mục	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_status`) VALUES
(15, 'Lập trình', '1'),
(16, 'Thiết kế đồ họa', '1'),
(17, 'Marketing', '1');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_price_sale` int(11) NOT NULL,
  `course_price` int(11) NOT NULL,
  `course_image` varchar(50) NOT NULL,
  `course_content` text NOT NULL,
  `course_require` text NOT NULL,
  `course_desc` text NOT NULL,
  `course_status` tinyint(1) NOT NULL DEFAULT 1,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_price_sale`, `course_price`, `course_image`, `course_content`, `course_require`, `course_desc`, `course_status`, `category_id`, `created_at`) VALUES
(23, 'Thiết kế web với HTML5-CSS3-JavaScript', 990000, 1200000, 'Thiet_ke_web_voi_HTML5_CSS3_JavaScript.jpg', 'Kiến thức về HTML5;Kiến thức về CSS3;Kiến thức về JavaScript', 'Không yêu cầu kiến thức', 'Với mong muốn được hỗ trợ mọi người từ những bước đầu tiên vào ngành lập trình, mình đã cho ra mắt khoá học Javascript cho người mới bắt đầu này. Vì nội dung nhắm tới những bạn chưa biết gì cũng có thể học được, nên nội dung được chuẩn bị rất kĩ lưỡng về các thuật ngữ, cũng như từng chi tiết lập trình nhỏ, để mọi người có thể tiếp thu một cách dễ dàng, nhanh chóng.\r\n\r\nNgoài việc tập trung vào kiến thức của ngôn ngữ Javascript, mình cũng có đan xen vào phần giải thuật cơ bản, giúp các bạn vừa có được kiến thức về Javascript vừa có kiến thức về lập trình cơ bản, để có thể tự tin hơn ở những chặng đường tiếp theo.\r\n\r\nNếu các bạn chưa học hoặc đang học mà chưa nắm vững được javascript thì mình tin chắc khoá học này sẽ giúp bạn đạt được điều đó.\r\n\r\nHẹn gặp các bạn trong khoá học nhé!', 1, 15, '2024-05-13 09:03:48'),
(24, 'Khóa học Javascript Chuyên Sâu', 0, 820000, 'Khoa_hoc_Javascript_Chuyen_Sau.jpg', 'Hiểu rõ scope trong Javascript; Hiểu rõ toán tử trong Javascript;Hiểu rõ Object và Function trong Javascript;Xử dụng thành thạo syntax của ES6;Áp dụng kiến thức Javascript và các framework phổ biến hiện nay', 'Cơ bản về biến, vòng lặp ở bất kỳ ngôn ngữ lập trình nào', 'Tại sao nên học Javascript?\r\nHiện tại tính ứng dụng của Javascript rất lớn từ  lập trình web front end với các framework hàng đầu: JQuery, React, Angular, VueJS backend với các framework của NodeJS lập trình ứng dụng di động với React Native, Ionic, NativeScript,... Lập trình game với Unity, Lập trình robot, IoT. Xu hướng gần đây của giới lập trình là full stack developer, để tránh việc dùng nhiều ngôn ngữ thì lựa chọn Javascript là khả dĩ nhất.', 1, 15, '2024-05-13 09:09:23'),
(25, 'Lập trình Hướng đối tượng với C++ cơ bản đến nâng cao', 0, 720000, '552190_c48b_5.jpg', 'Khóa học hướng dẫn lập trình hướng đối tượng từ cơ bản đến nâng cao;Áp dụng và hiểu rõ lập trình hướng đối tượng trên C++', 'Tinh thần tự học;Hoàn thành bài tập;Đặt câu hỏi và thảo luận với các bạn học viên khác', 'Bạn sẽ không phí tiền vô ích!\r\n\r\nBạn hoàn toàn yên tâm chất lượng của khóa học, nếu bạn không hài lòng vì bất kỳ lý do nào, bạn có thể yêu cầu hoàn trả 100% học phí bởi vì Udemy có chính sách đảm bảo 30 ngày.\r\n\r\nLập trình Hướng đối tượng với C++ cơ bản đến nâng cao\r\n\r\nVề khóa học:  \r\n\r\nLập trình Hướng đối tượng là một trong những phương pháp lập trình mà mọi lập trình viên đều phải biết và sử dụng thành thạo.  \r\n\r\nKhóa học này sẽ hướng dẫn bạn tất cả các khái niệm từ cơ bản đến về lập trình hướng đối tượng với C++. Mỗi bài học được trình bày với lý thuyết và ví dụ minh họa dễ hiểu.  \r\n\r\nKhóa học thích hợp với những bạn muốn hiểu rõ về phương pháp lập trình hướng đối tượng.  ', 1, 15, '2024-05-13 09:15:39'),
(26, 'ReactJS cho người mới bắt đầu', 820000, 12000000, 'ReactJS_cho_nguoi_moi_bat_dau.jpg', 'Kiến thức nền tảng của ReactJS;Quản lý form hiệu quả với React Hook Form;Quản lý state với Redux Toolkit;Làm giao diện nhanh và đơn giản với Material UI;Cách tổ chức files và folders như thế nào để dễ quản lý;Cùng mình code một dự án Shopping Cart để các bạn thấy được việc vận dụng kiến thức vào thực hành như thế nào.', 'Kiến thức về HTML, CSS; Kiến thức về Javascript', 'Ngoài việc giúp bạn nắm vững kiến thức cơ bản và nâng cao kỹ năng lập trình, khóa học ReactJS còn mang lại nhiều lợi ích khác. Đầu tiên, nó giúp bạn hiểu rõ hơn về cách xây dựng các ứng dụng web hiện đại và tương tác người dùng một cách linh hoạt. Điều này làm cho bạn trở nên linh hoạt và có khả năng thích ứng nhanh chóng với các yêu cầu thay đổi trong ngành công nghiệp phần mềm. Không chỉ dừng lại ở việc biết sử dụng ReactJS, mà khóa học còn hướng dẫn cách tích hợp nó với các công cụ và thư viện khác, như Redux, để quản lý trạng thái ứng dụng một cách hiệu quả. Điều này tăng cường khả năng làm việc nhóm và tạo ra mã nguồn dễ bảo trì. Cuối cùng, việc sở hữu kỹ năng ReactJS sẽ giúp bạn thăng tiến trong sự nghiệp nhanh chóng, vì nó là một công nghệ ngày càng được ưa chuộng và có ảnh hưởng mạnh mẽ đến ngành công nghiệp phần mềm. Điều này không chỉ mang lại cơ hội việc làm mà còn mở ra cánh cửa cho các dự án thú vị và thách thức trong tương lai.', 1, 15, '2024-05-13 09:19:57'),
(27, 'Khóa học Bootstrap cho người mới bắt đầu', 420000, 550000, 'Khoa_hoc_Bootstrap_cho_nguoi_moi_bat_dau.jpg', 'Nắm được tổng quan về Bootstrap;Tạo trang web tĩnh bằng Bootstrap cơ bản', 'Có kiến thức về HTML, CSS', '1. Giới thiệu tổng quan\r\n\r\nKhóa học Bootstrap Online miễn phí được thiết kế để hướng dẫn người học tạo được giao diện trang web đầy đủ các thành phần, tiết kiệm thời gian và có thể hoạt động tối ưu trên mọi kích thước màn hình. Các bài học được thiết kế hướng project-base. Sau mỗi bài học, học viên sẽ thấy được ngay sản phẩm của mình tương ứng với một phần của trang web. Kết thúc khóa học, học viên có thể tạo được trang web hoàn chỉnh sử dụng Bootstrap Framework.\r\n\r\n2. Học viên sẽ học được những gì?\r\nP1: Tổng quan về Bootstrap\r\nP2: Tạo thành phần trang web – Header – Book Overview – Author\r\nP3: Tạo thành phần trang web – Features – Prices – Download\r\nP4: Tạo thành phần trong trang web – Reader’s Say – Footer\r\nP5: Định dạng trang web bằng CSS\r\nP6: Định dạng trang web bằng JS\r\n\r\n3. Khóa học này dành cho ai?\r\n- Sinh viên và người đi làm trái ngành quan tâm đến lập trình web\r\n- Học sinh cấp 3 có đam mê với tin học và muốn tìm hiểu về lập trình căn bản web\r\n\r\n4. Tại sao nên tham gia khóa học?\r\n\r\n1. Giảng viên dày dặn kinh nghiệm: Bạn sẽ được hướng dẫn bởi giảng viên giàu kinh nghiệm và nhiệt tình. Bạn sẽ được đồng hành từng bước trong hành trình học tập.\r\n2. Thời gian và địa điểm linh hoạt: Khóa học này cho phép bạn học tại bất kỳ đâu có kết nối internet. Bạn có thể tự quản lý thời gian học tập và tích hợp học vào lịch trình hàng ngày của mình.\r\n3. Dự án thực tế: Bạn sẽ có sản phẩm ngay sau khoá học.\r\n4. Hỗ trợ và tương tác: Bạn sẽ được hỗ trợ và tương tác với cộng đồng học viên đồng nghiệp và giảng viên thông qua diễn đàn trực tuyến và nhóm học tập.\r\n5. Điều kiện tiên quyết\r\nKhông có điều kiện tiên quyết yêu cầu. Chỉ cần đam mê và sự tò mò về lập trình là bạn đã sẵn sàng bắt đầu hành trình này!', 1, 15, '2024-05-13 09:22:12'),
(28, 'Lập trình Python', 0, 1100000, 'Lap_trinh_Python.jpg', 'Kiến thức cơ bản bao gồm: in ấn, nhập liệu, điều kiện, vòng lặp, list, tupble, dictionary, hàm;Kiến thức về lập trình OOP: Lớp, đối tượng, hàm tạo, Getter và Setter, thừa kế', 'Không yêu cầu kiến thức', ' Khóa học \"Lập trình Python từ cơ bản đến nâng cao\" là một khóa học toàn diện dành cho những người muốn học lập trình Python hoặc nâng cao kiến thức của mình về ngôn ngữ lập trình này. Khóa học bao gồm một loạt các bài giảng, bài tập và dự án thực tế nhằm giúp học viên hiểu rõ về cú pháp Python, các khái niệm quan trọng, và phát triển kỹ năng lập trình Python đáng kể.', 1, 15, '2024-05-13 09:24:06'),
(29, 'Lập trình C cơ bản', 500000, 620000, '5431110_a3cf.jpg', 'Nắm được các kiến thức và kỹ thuật cơ bản của ngôn ngữ lập trình C;Định hướng phát triển tư duy lập trình;Vận dụng được kiến thức tiếp thu được thông qua các bài tập và dự án', 'Không yêu cầu về kiến thức', 'Xin chào các bạn đến với khóa học Lập trình C cơ bản của chúng tôi!\r\n\r\n        Sau nhiều năm kinh nghiệm trong công tác giảng dạy và các dự án lĩnh vực lập trình C, tiếp xúc với nhiều học viên, thực tập sinh. Chúng tôi biết rằng, bắt đầu lập trình có thể đối mặt với rất nhiều khó khăn như thiếu kiến thức nền tảng, không định hướng được vấn đề và cách thức giải quyết, thiếu tài liệu và hướng dẫn phù hợp,... Nắm bắt được vấn đề nêu trên, khóa học \"Lập trình C căn bản\" được thiết kế một cách chi tiết, khoa học, dễ hiểu, dễ tiếp thu, không yêu cầu kiến thức lập trình trước đó , bất kỳ ai muốn học lập trình đều có thể tham gia.\r\n\r\n        Trong khóa học, bạn sẽ được tìm hiểu các khái niệm từ cơ bản đến nâng cao. Được học cách sử dụng các công cụ và kỹ thuật lập trình để giải quyết các bài toán thực tế thông qua lập trình C. Bên cạnh đó, bạn cũng sẽ được thực hành với các bài tập và dự án thú vị, giúp bạn áp dụng và củng cố kiến thức đã học.', 1, 15, '2024-05-13 09:25:47'),
(30, 'Lập trình Web với PHP', 0, 720000, 'Lap_trinh_Web_voi_PHP.jpg', 'Sử dụng được cú pháp ngôn ngữ PHP;Sử dụng được các hàm thông dụng của các lớp thông dụng (String, Math, DateTime...);Sử dụng được try-catch, xử lý được ngoại lệ;Triển khai được cơ chế ghi đè phương thức (method overloading)', 'Không yêu cầu kiến thức', 'Kiến thức trong khóa học giúp học viên nắm vững các khái niệm và kỹ thuật cốt lõi trong lập trình, nâng cao tư duy và kỹ năng lập trình. Kết thúc khóa học này, học viên thành thạo việc phát triển các ứng dụng dựa trên ngôn ngữ PHP, phát triển các ứng dụng dựa trên ngôn ngữ PHP, mô hình lập trình Hướng đối tượng. Học viên cũng được triển khai kiến trúc phần mềm, xây dựng hệ thống web.\r\n\r\n1. Ngôn ngữ PHP\r\n\r\nTrong học phần này, học viên sẽ làm chủ cú pháp của ngôn ngữ PHP. Kết thúc học phần, học viên có thể sử dụng ngôn ngữ PHP để phát triển các ứng dụng phần mềm đơn giản.\r\n\r\nCác mục tiêu của học phần:\r\n\r\nSử dụng được cú pháp ngôn ngữ PHP\r\n\r\nSử dụng được try-catch, xử lý được ngoại lệ\r\n\r\nĐọc và ghi được file text và file nhị phân\r\n\r\nĐọc hiểu được mã nguồn do người khác viết\r\n\r\nĐọc được API của các thư viện\r\n\r\nSử dụng được các hàm thông dụng của các lớp thông dụng (String, Math, DateTime...)\r\n\r\n2. Lập trình hướng Đối tượng nâng cao\r\n\r\nTrong học phần này, học viên sẽ rèn luyện mô hình Lập trình hướng Đối tượng, các đặc điểm quan trọng của Lập trình hướng Đối tượng, có khả năng thiết kế được các giải pháp cơ bản sử dụng theo mô hình hướng Đối tượng.\r\n\r\nCác mục tiêu của học phần:\r\n\r\nTriển khai được cơ chế ghi đè phương thức (method overloading)\r\n\r\nTrình bày được mô hình phát triển Hướng đối tượng\r\n\r\nThiết kế được các giải pháp cơ bản sử dụng theo mô hình Hướng Đối tượng\r\n\r\nKhai báo được lớp, sử dụng được đối tượng, thuộc tính, phương thức, constructor\r\n\r\nSử dụng được access modifer\r\n\r\nSử dụng được thuộc tính static, phương thức static, getter/setter\r\n\r\nTriển khai được cơ chế nạp chồng phương thức (overloading)\r\n\r\nSử dụng được các hàm thông dụng của các lớp thông dụng (String, Math, LocalDate...)\r\n\r\nTriển khai được cơ chế kế thừa\r\n\r\nKhai báo và sử dụng được abstract class và interface\r\n\r\nSử dụng được các ký hiệu UML để mô tả lớp, interface và các mối quan hệ\r\n\r\nSử dụng được các ký hiệu UML để mô tả biểu đồ activity', 1, 15, '2024-05-13 09:52:37'),
(31, 'Khóa học Figma từ căn bản đến thực chiến', 990000, 1420000, 'Khoa_hoc_Figma_tu_can_ban_den_thuc_chien.jpg', 'Sử dụng thành thục figma;Hình thành tư duy hệ thống hóa thiết kế với figma;Quản lý mọi thành phần trong thiết kế một cách khoa học, giảm thiểu thao tác thừa', 'Không yêu cầu kiến thức', 'KHÓA HỌC NÀY CÓ GÌ\r\n\r\nKhóa học thiết kế giao diện bằng Figma dành cho những bạn có đam mê với ngành nghề UI/UX design. Khóa học tập trung vào những kỹ năng căn bản nhất, đồng thời cung cấp một cái nhìn tổng quát giúp học viên có thể tạo ra sản phẩm cụ thể sau khóa học.\r\n\r\nKHÓA HỌC SẼ DẠY NHỮNG GÌ?\r\n\r\nBạn sẽ được tiếp kiến thức thực chiến từ đội ngũ TELOS, bao gồm các Developer và Designer cùng quản lý công việc và trao đổi trên một file làm việc Figma hơn 3 năm, bao gồm:\r\n\r\nCách một dự án thiết kế giao diện UI/UX được thực thi\r\n\r\nKiến thức căn bản về cách tận dụng Figma\r\n\r\nCác mẹo vặt để làm việc khoa học và tư duy theo lối lập trình\r\n\r\nPhương pháp nghiên cứu để luôn tìm ra câu trả lời cho cái mình chưa biết trong Figma\r\n\r\nVun đắp mối quan hệ Designer - Developer với những sản phẩm ăn ý', 1, 16, '2024-05-13 09:55:38'),
(32, 'Adobe Photoshop từ cơ bản đến nâng cao', 0, 1500000, 'Adobe_Photoshop_tu_co_ban_den_nang_cao4.jpg', 'Sử dụng thành thạo công cụ Adobe Photoshop;Kiến thức nền tảng về chỉnh sửa ảnh;Luyện tập thiết kế Banner, Poster, Standee, ấn phẩm truyền thông;Cắt ghép hình ảnh cơ bản đến nâng cao', 'Không yêu cầu kiến thức', 'Cuộc sống hiện đại, vây quanh bạn đều là sản phẩm của thiết kế: từ bảng biển quảng cáo, bao bì sản phẩm, hình ảnh truyền thông, mạng xã hội, v.v... Hình ảnh và những nội dung trực quan, bắt mắt, giúp nắm bắt thông tin nhanh, đang được ưa chuộng hơn bao giờ hết. Mọi đơn vị, tổ chức, doanh nghiệp khi muốn quảng bá ra công chúng đều cần chăm chút và thiết kế hình ảnh, khiến độ hot của vị trí phụ trách công việc này sẽ không hạ nhiệt trong nhiều năm tới. Bởi lẽ đó, đừng chần chừ mà hãy tìm hiểu về Photoshop ngay thôi!\r\nPhotoshop - phần mềm cực kỳ mạnh mẽ với khả năng chỉnh sửa thiên biến vạn hóa, là nội dung không thể thiếu trong bất kỳ một chương trình đào tạo về thiết kế hình ảnh nào. E-ColorME giới thiệu khóa học \"Làm chủ Photoshop từ cơ bản đến nâng cao\" nhằm giúp bạn học viên hiểu và nhanh chóng làm quen với Photoshop, cùng với vô số bài tập thực hành nhỏ, đảm bảo tính ứng dụng: học xong làm được ngay. Là \"bước chân đầu tiên\" trong lộ trình học Photoshop, khóa học giúp bạn tạo ra poster ấn phẩm truyền thông, photo quote, manipulation đơn giản và hình ảnh mock-up.', 1, 16, '2024-05-13 09:58:19'),
(33, 'Làm hiệu ứng video với After Effects', 0, 1820000, 'Lam_hieu_ung_video_voi_After_Effects.jpg', 'Cách sử dụng các công cụ trong After Effects để tạo video;Nắm được cơ chế hoạt động của các loại Layer trong After Effects;Cách sử dụng các Layer Shape - Solid để tạo hiệu ứng video', 'Không yêu cầu kiến thức', 'Kỹ xảo hình ảnh là một trong những yếu tố quan trọng trong sản xuất video, giúp video trở nên sống động và thu hút hơn. Sử dụng kỹ xảo đang trở thành xu hướng quảng cáo mới, giúp nâng cao giá trị thương hiệu, đem lại nhiều lợi nhuận hơn.\r\n\r\n\r\n\r\nVậy làm sao để có một sản phẩm sử dụng kỹ xảo chuyên nghiệp, bắt mắt ? Tất cả sẽ được giải đáp trong khóa học \"Làm hiệu ứng video với After Effects\". Khóa học sẽ trang bị cho học viên những kiến thức cơ bản về kỹ xảo đa phương tiện và cách tạo các kỹ xảo hình ảnh bằng phần mềm ADOBE AFTER EFFECTS. Bạn sẽ hiểu rõ quy trình làm việc của phần mềm Adobe After Effects, biết cách áp dụng các kỹ xảo điện ảnh chuyên nghiệp bằng phần mềm Adobe After Effects để tạo kỹ xảo theo yêu cầu. Đặc biệt người sẽ hướng dẫn các bạn trong khóa học này là thầy Tú Thanh - đã có nhiều năm kinh nghiệm đào tạo trong lĩnh vực truyền thông media tại nhiều trường đại học cũng như đang là đối tác của các thương hiệu như: Sony, Asus, Topica, Gitiho... Đồng thời cũng là Founder của Tú Thanh Media & Tú Thanh Academy chuyên về sản xuất - đào tạo media.', 1, 16, '2024-05-13 10:02:24'),
(34, 'Blender 2023 - Lần đầu làm quen & tiếp xúc với 3D', 1200000, 1500000, 'Blender_2023_Lan_dau_lam_quen_tiep_xuc_voi_3D.jpg', 'Từ 0 biết gì về 3D & Blender -> dựng hình + chụp ảnh quảng cáo trong 3D;Nhanh chóng hiểu được cơ bản Blender (1 phần mềm khó nhưng rất mạnh)', 'Không yêu cầu kiến thức', 'Blender là phần mềm mã nguồn mở hoàn toàn miễn phí nhưng lại vô cùng mạnh mẽ, không thua các phần mềm khác trong cùng phần khúc. Trong khóa học này, các bạn sẽ làm quen với các tính năng và công cụ cơ bản của Blender, để từ đó làm nền tảng để có thể bước sâu hơn vào thế giới của 1 học sĩ 3D.\r\n\r\nBạn chưa từng biết gì về 3D hay chưa từng làm đồ họa hay thiết, khóa học này không hề đòi hỏi bất kỳ kỹ năng hay kinh nghiệm có sẵn của bạn.\r\n\r\n\r\n\r\n3D BLENDER ÁP DỤNG VÀO ĐÂU?\r\n\r\nQuay TVC cho sản phẩm (Phim quảng cáo)\r\n\r\nEdit video, làm hiệu ứng VFX trên Tiktok, Youtube…\r\n\r\nIn ấn 3D, dùng mô hình tạo ra trong Blender để in 3D\r\n\r\nSử dụng hình ảnh render từ Blender in ấn để làm POD\r\n\r\nBán mô hình 3D trên TurboSquid, Amazon, Etsy...\r\n\r\nNhận dự án 3D tự do - Freelancer\r\n\r\nCấp độ Beginner – Khởi Động:\r\n\r\nDành cho những bạn chưa từng biết đến 3D hay VFX trên bất kỳ phần mềm nào.\r\n\r\nDành cho các bạn chưa từng làm về đồ họa, thiết kế nhưng mong muốn tìm hiểu để biết mình có phù hợp không.\r\n\r\nDành cho cả các bạn chưa biết vẽ 2D.\r\n\r\n\r\n\r\nCấu hình máy tính phù hợp khóa học:\r\n\r\nTối thiểu là:  64-bit quad core CPU with SSE2 support 8 GB RAM Full HD display Mouse, trackpad or pen+tablet Graphics card with 2 GB RAM, OpenGL 4.3\r\n\r\nĐược Blender gợi ý sử dụng là:  64-bit eight core CPU 32 GB RAM 2560×1440 display Three button mouse or pen+tablet Graphics card with 8 GB RAM', 1, 16, '2024-05-13 10:04:05'),
(35, 'Quảng cáo Zalo cho Mọi Người: 100% thực hành', 0, 850000, 'Quang_cao_Zalo_cho_Moi_Nguoi_100_thục_hành.jpg', 'Hiểu về Zalo Ads: Bạn sẽ hiểu cách hoạt động của Zalo Ads, cách tạo và quản lý quảng cáo trên nền tảng này.;Tạo chiến dịch quảng cáo: Bạn sẽ có khả năng tạo các chiến dịch quảng cáo trên Zalo, bao gồm viết nội dung, thiết lập mục tiêu, và tối ưu hóa hình', 'Không yêu cầu kiến thức', 'Bạn đang tìm kiếm cách hiệu quả để quảng cáo sản phẩm hoặc dịch vụ của bạn và tiếp cận hàng triệu khách hàng tiềm năng trên nền tảng Zalo ?\r\n\r\nKhoá học \"Quảng cáo Zalo cho Mọi Người: 100% thực hành\" là lựa chọn hoàn hảo cho bạn.\r\n\r\nZalo Ads là một trong những nền tảng quảng cáo trực tuyến phổ biến tại Việt Nam, có sẵn cho hàng triệu người dùng trên ứng dụng Zalo. Khoá học này sẽ giúp bạn tận dụng tiềm năng mạnh mẽ của Zalo để xây dựng chiến dịch quảng cáo thành công và tăng doanh số bán hàng.', 1, 17, '2024-05-13 10:05:49'),
(36, 'Chatbot thu hút 10.000+ khách hàng với chi phí 0 ĐỒNG', 0, 550000, 'chatbot.jpg', 'Làm chủ chatbot trong 1 ngày không cần biết về code;Chatbot tự động chăm sóc khách hàng;Quản lý toàn bộ khách hàng trên chatbot', 'Không yêu cầu kiến thức', 'Bạn đang bán hàng online trên facebook, sinh viên muốn khởi nghiệp, hay nhân viên văn phòng muốn kiếm công việc làm thêm online?\r\n\r\nthì bán hàng trên facebook là lựa chọn số 1 hiện nay ở Việt nam.\r\n\r\nNhưng\r\n\r\nBạn không biết bắt đầu từ đâu, không biết quảng cáo, không biết thu hút khách hàng, không biết chăm sóc khách hàng, ...và rất nhiều thứ đau đầu gặp phải khi bán hàng.\r\n\r\nThì\r\n\r\nđây là khoá học được thiết kế  dành riêng cho bạn, hướng dẫn bạn chi tiết từ cơ bản đến nâng cao, cách xây dựng một chương trình bán hàng hoàn chỉnh sử dụng chatbot, chăm sóc khách hàng tự động, theo dõi khách hàng, tiếp thị lại, đặc biệt công thức viral thu hút 10.000+ khách hàng với chi phí 0 đồng.', 1, 17, '2024-05-13 10:07:55'),
(38, 'Laravel cho người mới bắt đầu', 720000, 990000, 'khoa-hoc-laravel-cho-nguoi-moi-bat-dau.jpg', 'Kiến thức về Laravel; Xây dựng dự án shop bán hàng ở cuối khóa', 'Nắm vững kiến thức về lập trình PHP cơ bản; Có hiểu biết về Lập trình hướng đối tượng', 'Bắt đầu hành trình với Laravel của bạn với khóa học toàn diện của chúng tôi, được thiết kế dành cho người mới bắt đầu! Laravel đã nổi lên như một lựa chọn hàng đầu trong cộng đồng lập trình viên PHP nhờ sự đơn giản, hiệu suất cao và bộ công cụ phong phú giúp tối ưu hóa quá trình phát triển web. Khi PHP 8 ra mắt, Laravel đã sẵn sàng để định hình lại cách bạn nhìn nhận về PHP. Nó giống như Ruby on Rails trong vũ trụ PHP, và thậm chí có thể vượt trội hơn. Laravel biểu đạt, thú vị, trôi chảy, dễ học và dễ sử dụng. Cả người mới và các chuyên gia lâu năm đều không thể ngừng yêu thích nó! Bây giờ, bạn có cơ hội tham gia vào cộng đồng những người hài lòng với việc xây dựng và kiếm tiền từ các dự án của mình.', 1, 15, '2024-07-02 08:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `course_chapters`
--

CREATE TABLE `course_chapters` (
  `chapter_id` int(11) NOT NULL,
  `chapter_name` varchar(255) NOT NULL,
  `chapter_desc` text NOT NULL,
  `chapter_order` int(2) NOT NULL,
  `chapter_status` int(11) NOT NULL DEFAULT 1,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `course_chapters`
--

INSERT INTO `course_chapters` (`chapter_id`, `chapter_name`, `chapter_desc`, `chapter_order`, `chapter_status`, `course_id`) VALUES
(18, 'Chương 1: Bắt đầu', 'Giới thiệu về khóa học', 1, 1, 23),
(19, 'Chương 2: Làm quen với HTML', 'Giới thiệu các khái niệm về HTML', 2, 1, 23),
(20, 'Chương 3: Làm quen với CSS', 'Giới thiệu các khái niệm về CSS', 3, 1, 23),
(21, 'Chương 1: Giới thiệu', 'Giới thiệu về khóa học', 1, 1, 24),
(22, 'Chương 2: Biến, comment, built-in', 'Làm quen với các khái niệm', 2, 1, 24),
(23, 'Chương 3: Toán tử, kiểu dữ liệu', 'Tìm hiểu về toán tử, kiểu dữ liệu', 3, 1, 24),
(24, 'Chương 1: Giới thiệu', 'Giới thiệu về khóa học', 1, 1, 25),
(25, 'Chương 2: Biến và kiểu dữ liệu', 'Giới thiệu về biến và kiểu dữ liệu', 2, 1, 25),
(26, 'Chương 3: Cấu trúc điều khiển và vòng lặp', 'Các khái niệm quan trọng', 3, 1, 25),
(29, 'Chương 1: Giới thiệu', 'Giới thiệu giảng viên và khóa học', 1, 1, 38);

-- --------------------------------------------------------

--
-- Table structure for table `course_lessons`
--

CREATE TABLE `course_lessons` (
  `lesson_id` int(11) NOT NULL,
  `lesson_name` varchar(255) NOT NULL,
  `lesson_order` int(3) NOT NULL,
  `lesson_path` varchar(50) NOT NULL,
  `lesson_status` tinyint(1) NOT NULL DEFAULT 1,
  `chapter_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `course_lessons`
--

INSERT INTO `course_lessons` (`lesson_id`, `lesson_name`, `lesson_order`, `lesson_path`, `lesson_status`, `chapter_id`) VALUES
(34, 'Bài 1: Bạn sẽ làm được gì sau khóa học?', 1, 'Bai_1_Ban_se_lam_duoc_gi_sau_khoa_hoc.mp4', 1, 18),
(35, 'Bài 2: Tìm hiểu về HTML, CSS', 2, 'Bai_2_Tim_hieu_ve_HTML_CSS.mp4', 1, 18),
(36, 'Bài 3: Làm quen với Dev tools', 3, 'Bai_3_Lam_quen_voi_Dev_tools.mp4', 1, 18),
(37, 'Bài 4: Cấu trúc 1 file HTML', 4, 'Bai_4_Cau_truc_1_file_HTML.mp4', 1, 19),
(38, 'Bài 5: Comment trong HTML', 5, 'Bai_5_Comments_trong_HTML.mp4', 1, 19),
(39, 'Bài 6: Các thẻ HTML thông dụng', 6, 'Bai_6_Nhung_the_HTML_thong_dung.mp4', 1, 19),
(40, 'Bài 7: Sử dụng CSS trong HTML', 7, 'Bai_7_Su_dung_CSS_trong_HTML.mp4', 1, 20),
(41, 'Bài 8: ID và Class', 8, 'Bai_8_ID_va_Class.mp4', 1, 20),
(42, 'Bài 9: CSS selectors cơ bản ', 9, 'Bai_9_CSS_selectors_co_ban.mp4', 1, 20),
(43, 'Bài 1: Lời khuyên trước khóa học', 1, 'Bai_1_Loi_khuyen_truoc_khoa_hoc.mp4', 1, 21),
(44, 'Bài 2: Cài đặt môi trường', 2, 'Bai_2_Cai_dat_moi_truong.mp4', 1, 21),
(45, 'Bài 3: Sử dụng Javascript với HTML', 3, 'Bai_3_Su_dung_Javascript_voi_HTML.mp4', 1, 22),
(46, 'Bài 4: Khái niệm biến và cách sử dụng', 4, 'Bai_4_Khai_bao_bien.mp4', 1, 22),
(47, 'Bài 5: Cú pháp comments là gì?', 5, 'Bai_5_Cu_phap_comments_la_gi.mp4', 1, 22),
(48, 'Bài 6: Làm quen với toán tử', 6, 'Bai_6_Lam_quen_voi_toan_tu.mp4', 1, 23),
(49, 'Bài 7: Toán tử số học', 7, 'Bai_7_Toan_tu_so_hoc.mp4', 1, 23),
(50, 'Bài 8: Toán tử gán', 8, 'Bai_8_Toan_tu_gan.mp4', 1, 23),
(51, 'Bài 1: Giới thiệu khóa học', 1, 'Bai_1_Gioi_Thieu_khoa_hoc_CPlusPlus.mp4', 1, 24),
(52, 'Bài 2: Cài đặt Dev C++', 2, 'Bai_2_Cai_dat_Dev_C.mp4', 1, 24),
(53, 'Bài 3: Hướng dẫn sử dụng Dev C++', 3, 'Bai_3_Huong_dan_su_dung_Dev_C.mp4', 1, 24),
(54, 'Bài 4: Biến và nhập xuất dữ liệu', 4, 'Bai_4_Bien_va_nhap_xuat_du_lieu.mp4', 1, 25),
(55, 'Bài 5: Kiểu dữ liệu thường gặp', 5, 'Bai_5_Kieu_du_lieu_thuong_gap.mp4', 1, 25),
(56, 'Bài 6: Biến cục bộ và biến toàn cục', 6, 'Bai_6_Bien_cuc_bo_va_bien_toan_cuc.mp4', 1, 25),
(57, 'Bài 7: Cấu trúc if else', 7, 'Bai_7_Cau_truc_if_else.mp4', 1, 26),
(58, 'Bài 8: Cấu trúc switch case', 8, 'Bai_8_Cau_truc_switch_case.mp4', 1, 26),
(59, 'Bài 9: Toán tử 3 ngôi', 9, 'Bai_9_Toan_tu_3_ngoi.mp4', 1, 26),
(61, 'Bài 1: Chào mừng bạn đến với khóa học', 1, 'Bai-1-chao-mung-ban-den-voi-khoa-hoc.mp4', 1, 29);

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `feedback_username` varchar(50) NOT NULL,
  `feedback_email` varchar(50) NOT NULL,
  `feedback_tel` varchar(20) NOT NULL,
  `feedback_content` text NOT NULL,
  `feedback_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Feedback chưa được phản hồi, 1: Feedback đã được phản hồi',
  `feedback_reply` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`feedback_id`, `feedback_username`, `feedback_email`, `feedback_tel`, `feedback_content`, `feedback_status`, `feedback_reply`, `created_at`, `user_id`) VALUES
(1, 'Huy', 'huy12@gmail.com', '09287346', 'Khi nào có đợt giảm giá?', 1, 'Đợt giảm giá sẽ có vào cuối tháng sau', '2023-11-15 04:05:39', 2),
(2, 'Nam Nguyễn', 'namng@gmail.com', '0982374', 'Trang web của bạn thật tiện lợi', 0, '', '2023-11-15 04:06:34', NULL),
(3, 'Quỳnh', 'quynh22@gmail.com', '092736423', 'Thật tiện lợi khi sử dụng trang web ở điện thoại', 1, 'Cảm ơn bạn, chúng tôi sẽ tiếp tục tối ưu trang web để mang lại trải nghiệm tốt hơn', '2023-11-15 04:07:59', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_money` int(11) NOT NULL DEFAULT 0,
  `order_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Chưa thanh toán, 1: thành công, 2: Hủy, 3: Không thành công',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `user_id`, `total_money`, `order_status`, `created_at`) VALUES
(58, 'OD27006', 47, 1920000, 1, '2024-07-03 05:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `course_id`) VALUES
(162, 58, 23),
(163, 58, 25);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `review_rate` int(1) NOT NULL,
  `review_content` text NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `review_rate`, `review_content`, `course_id`, `user_id`, `review_date`) VALUES
(18, 3, 'Khóa học ổn', 23, 38, '2024-06-01 01:52:56'),
(19, 5, 'Rất may mắn khi đã học khóa học này!', 23, 38, '2024-06-01 01:53:18'),
(20, 3, 'Giảng viên rất tâm huyết!', 25, 38, '2024-06-01 01:53:59'),
(21, 5, 'Hy vọng khóa học được cập nhật!', 25, 38, '2024-06-01 01:54:13'),
(22, 5, 'Khóa học rất hay!', 23, 41, '2024-07-02 01:43:21'),
(23, 4, 'Khóa học rất tốt!', 23, 43, '2024-07-02 03:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `slider_id` int(11) NOT NULL,
  `slider_img` varchar(50) NOT NULL,
  `slider_status` tinyint(4) NOT NULL DEFAULT 1,
  `slider_order` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`slider_id`, `slider_img`, `slider_status`, `slider_order`) VALUES
(1, 'newBanner1.png', 1, 1),
(2, 'newBanner2.png', 1, 2),
(3, 'newBanner3.png', 1, 3),
(5, 'Blue Welcome to Online Learning Class Banner.png', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_loginName` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_avatar` varchar(255) DEFAULT 'avatar_default.png',
  `user_email` varchar(50) NOT NULL,
  `user_phone` varchar(10) NOT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT 1,
  `roles` tinyint(4) NOT NULL COMMENT '1: SuperAdmin, 2: Admin; 3: User',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_loginName`, `user_password`, `user_avatar`, `user_email`, `user_phone`, `user_status`, `roles`, `created_at`) VALUES
(21, 'Nguyen Hung Bac', 'superadmin', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'default-avatar.png', 'bacnguyenfsd@gmail.com', '', 1, 1, '2023-11-29 08:14:37'),
(45, 'admin01', 'admin01', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'avatar_default.png', 'admin01@gmail.com', '', 1, 2, '2024-07-03 05:05:03'),
(47, 'client01', 'client01', '$2y$10$cUnmBO6unEQ6GrxXvLB9qeUKuHi8PkxvCPV8AAQeBq4DO8DhvtXya', 'avatar_default.png', 'client01@gmail.com', '', 1, 3, '2024-07-03 05:11:11'),
(48, 'client02', 'client02', '$2y$10$R8aehJUDyYdgNJQffGiHVusS0hVLD0cLY7rBSbigtSXXGTJHkoFSe', 'avatar_default.png', 'client02@gmail.com', '', 1, 3, '2024-07-03 05:11:29'),
(49, 'admin02', 'admin02', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'avatar_default.png', 'admin02@gmail.com', '', 1, 2, '2024-07-03 05:12:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_courses`
--

CREATE TABLE `user_courses` (
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `brought_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_courses`
--

INSERT INTO `user_courses` (`user_id`, `course_id`, `brought_at`) VALUES
(38, 23, '2024-05-13 15:17:20'),
(38, 25, '2024-05-13 15:17:20'),
(38, 27, '2024-05-13 15:18:24'),
(38, 30, '2024-05-13 16:51:42'),
(41, 23, '2024-07-02 06:41:26'),
(41, 25, '2024-07-02 06:41:26'),
(43, 23, '2024-07-02 08:14:36'),
(43, 25, '2024-07-02 08:14:36'),
(47, 23, '2024-07-03 05:14:37'),
(47, 25, '2024-07-03 05:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `vnpay_infor`
--

CREATE TABLE `vnpay_infor` (
  `id_vnpay` int(11) NOT NULL,
  `vnp_TmnCode` varchar(100) NOT NULL,
  `vnp_Amount` int(11) NOT NULL,
  `vnp_BankCode` varchar(100) NOT NULL,
  `vnp_PayDate` varchar(100) NOT NULL,
  `vnp_OrderInfo` varchar(100) NOT NULL,
  `vnp_TransactionNo` varchar(100) NOT NULL,
  `vnp_ResponseCode` varchar(100) NOT NULL,
  `vnp_TransactionStatus` varchar(100) NOT NULL,
  `vnp_TxnRef` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vnpay_infor`
--

INSERT INTO `vnpay_infor` (`id_vnpay`, `vnp_TmnCode`, `vnp_Amount`, `vnp_BankCode`, `vnp_PayDate`, `vnp_OrderInfo`, `vnp_TransactionNo`, `vnp_ResponseCode`, `vnp_TransactionStatus`, `vnp_TxnRef`) VALUES
(30, '8JFJ26RJ', 192000000, 'NCB', '20240513221715', 'Thanh toan đơn hàng: OD19116', '14413204', '00', '00', '51'),
(31, '8JFJ26RJ', 55000000, 'NCB', '20240513221821', 'Thanh toan đơn hàng: OD40386', '14413205', '00', '00', '52'),
(32, '8JFJ26RJ', 72000000, 'NCB', '20240513235009', 'Thanh toan đơn hàng: OD35720', '14413300', '00', '00', '53'),
(33, '8JFJ26RJ', 72000000, 'NCB', '20240513235136', 'Thanh toan đơn hàng: OD59679', '14413305', '00', '00', '54'),
(34, '8JFJ26RJ', 192000000, 'NCB', '20240702134122', 'Thanh toan đơn hàng: OD36295', '14489072', '00', '00', '56'),
(35, '8JFJ26RJ', 192000000, 'NCB', '20240702151427', 'Thanh toan đơn hàng: OD21260', '14489331', '00', '00', '57'),
(36, '8JFJ26RJ', 192000000, 'NCB', '20240703121425', 'Thanh toan đơn hàng: OD27006', '14491081', '00', '00', '58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `course_chapters`
--
ALTER TABLE `course_chapters`
  ADD PRIMARY KEY (`chapter_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `course_lessons`
--
ALTER TABLE `course_lessons`
  ADD PRIMARY KEY (`lesson_id`),
  ADD KEY `chapter_id` (`chapter_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD PRIMARY KEY (`user_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `vnpay_infor`
--
ALTER TABLE `vnpay_infor`
  ADD PRIMARY KEY (`id_vnpay`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `course_chapters`
--
ALTER TABLE `course_chapters`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `course_lessons`
--
ALTER TABLE `course_lessons`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `vnpay_infor`
--
ALTER TABLE `vnpay_infor`
  MODIFY `id_vnpay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_chapters`
--
ALTER TABLE `course_chapters`
  ADD CONSTRAINT `course_chapters_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_lessons`
--
ALTER TABLE `course_lessons`
  ADD CONSTRAINT `course_lessons_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `course_chapters` (`chapter_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
