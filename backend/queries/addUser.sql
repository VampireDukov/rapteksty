IF EXISTS (SELECT * FROM users WHERE login ='$login')
    INSERT INTO users (login,mail,name,city,avatar,ip_addr,reg_date,last_log_date,active,permissions,famous,rang,banned,warns) VALUES (:login,:mail,:password,0,0,"$ip","$date",0,0,0,0,0,0,0, ))
ELSE
    INSERT INTO Table1 VALUES (...)