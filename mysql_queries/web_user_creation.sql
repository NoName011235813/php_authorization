drop user site_user;
create user site_user identified by 'anypassword';

grant all privileges
on library.*
to site_user;

ALTER USER 'site_user' IDENTIFIED WITH mysql_native_password BY 'anypassword';
flush privileges;
