
CREATE TABLE `sys_users` (

  `id` int NOT NULL,
  `fio` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` tinyint(1) NOT NULL,
  `prim` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `role` tinyint NOT NULL,
   `ro_flag` tinyint NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `sys_users` (`fio`, `nickname`, `email`, `is_confirmed`, `password_hash`, `auth_token`, `created_at`, `state`, `prim`, `role`, `ro_flag`) VALUES
('Супер Fдмин', 'root', 'root@root.root', 1, '$2y$11$487e0d4e1036017417106uiUACDdHrOAZpXwmUa1W/U2R73fhdiha', '1', '2021-10-11 21:15:33', 1, 'root', 0,1),
('Администратор системы/раздела', 'admin', 'admin@gmail.com', 1, '$2y$11$487e0d4e1036017417106uiUACDdHrOAZpXwmUa1W/U2R73fhdiha', '1', '2021-10-11 21:15:33', 1, 'тест', 0, 0),
('Редактор раздела', 'editor', 'editor@editor.editor', 1, '$2y$11$487e0d4e1036017417106uiUACDdHrOAZpXwmUa1W/U2R73fhdiha', '1', '2021-10-11 21:15:33', 1, 'тест', 0,0),
('Пользователь Специалист', 'spec', 'spec@spec.spec', 2, '$2y$11$dbc97b2646d324ca1ba3du8m9Ia9DIgYDDnWCIR7Afi1US7CMGsmC', '2', '2021-10-11 21:15:33', 1, 'тестирование', 0, 0),
('Скваж Сергей Михайлович', 'SkSeMi_88', 'sergeyskvazh@mail.ru', 1, '$2y$11$487e0d4e1036017417106uiUACDdHrOAZpXwmUa1W/U2R73fhdiha', 'f3999956605f4e025e3d38a0212ec024888e8af306fecdb92a1b876ade14160f1c917daaad8f9fc5', '2021-10-23 19:00:50', 1, 'test', 0, 0);
