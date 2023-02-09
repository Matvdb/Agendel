--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `user` (`id`, `role`, `nom`, `prenom`, `civilite`, `email`, `password`, `tel`, `create_at`) VALUES
(1, 'admin', 'Vanderbregt', 'Mathieu', 'Mr.', 'mathieuvanderbregt@gmail.com', '$2y$10$2J1NHcmZVGiJ7T3EWfIDH.1hDeD4XlKG1xLqkltV5UwPIOOy1AjzG', '0624638139', '2021-08-05 07:48:40'),
(2, 'user', 'user', 'user', 'Mme', 'user@gmail.com', '$2y$10$3ZnwXA1hl0oSTOmnRC7KRu4jh0d8eVsZfIWpT.6nPuuvpb.MU96tW', '032541563', '2021-08-05 07:49:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;	