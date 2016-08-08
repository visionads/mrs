
--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `auth_key`, `access_token`, `csrf_token`, `ip_address`, `business_id`, `last_visit`, `expire_date`, `remember_token`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'devdhaka407@gmail.com', '$2y$10$fh/TeCj9g46sJj7yvSK9ReHrdJcM57zIzNg0yR/CExV/sd6M1TCPi', '', '', '', '127.0.1.1', NULL, '2016-08-08 01:06:57', '2020-08-27 16:33:22', 'MXLDbme4DQbtr2WSiuKkhtDX1ACzDMPRSa0VXKdlkiGiKh04L2lxJz8AGT3N', 'active', 0, 1, '2016-02-22 20:57:55', '2016-08-07 23:32:49'),
(2, 'system-admin', 'devdhaka409@gmail.com', '$2y$10$fh/TeCj9g46sJj7yvSK9ReHrdJcM57zIzNg0yR/CExV/sd6M1TCPi', '', '', '', '127.0..1', NULL, '2015-08-27 16:33:22', '2020-08-27 16:33:22', '', 'active', 0, 0, '2016-02-22 20:57:55', '2016-02-22 20:57:55'),
(3, 'admin', 'admin@admin.com', '$2y$10$fh/TeCj9g46sJj7yvSK9ReHrdJcM57zIzNg0yR/CExV/sd6M1TCPi', '', '', '', '127.0.1.1', NULL, '2016-08-08 12:57:46', '2020-08-27 16:33:22', 'DrizVfXWfEhWOlexC383WxboEH43sl7PM8KZGQHG00d3ZSwpypvSinVjVesK', 'active', 0, 3, '2016-02-22 20:57:55', '2016-08-08 01:06:46'),
(4, 'accountant', 'devdhaka408@gmail.com', '$2y$10$0Mskcpfs8t6zSyMILPYOzenk1rs61P.kv0pNs/zIDVdPSU1F4vAw2', '', '', '', '127.0.1.1', NULL, '2015-08-27 16:33:22', '2020-08-27 16:33:22', '', 'active', 0, 0, '2016-02-22 20:57:55', '2016-02-22 20:57:55'),
(5, 'junior-accountant', 'devdhaka403@gmail.com', '$2y$10$0Mskcpfs8t6zSyMILPYOzenk1rs61P.kv0pNs/zIDVdPSU1F4vAw2', '', '', '', '127.0.1.1', NULL, '2015-08-27 16:33:22', '2020-08-27 16:33:22', '', 'active', 0, 0, '2016-02-22 20:57:55', '2016-02-22 20:57:55'),
(6, 'agent', 'agent@agent.com', '$2y$10$BhIIjcr8HVM4s1WNAarQuOLj0Ns3tgz6XSipEDGAUZE60rTtSsoZG', NULL, NULL, 'yT6NGHnXNAMAiX8OMU84lnNr0263RM', '127.0.1.1', 1, '2016-08-08 12:57:21', '2020-09-07 05:36:41', 'aeClHuaWD2OwNbc0qm0E8oOXDGKSrZu453cuXU50yshqGli3r30JJW2sFZP1', 'active', 3, 6, '2016-08-08 05:37:27', '2016-08-08 00:57:28');


