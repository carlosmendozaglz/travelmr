DROP PROCEDURE IF EXISTS p_Login;
DELIMITER $$
 
CREATE PROCEDURE p_Login(
    IN  pUser    VARCHAR(200),
    IN  pPass    VARCHAR(200))
BEGIN
    DECLARE lvName   Varchar(200) DEFAULT '';
    DECLARE lv   Varchar(200) DEFAULT '';
    Declare lnUserKey    Int;
    Declare lnAsistencia Int;

	SET lnUserKey:= (Select user_key
				       From user
				      Where user=pUser
					    And password=sha1(pPass));
	
    Set lnAsistencia = Ifnull((Select asistencia_key
								 From asistencia
								Where date_=curdate()
								  And user_key=lnUserKey), 0);

    if lnUserKey Is Not Null Then
		
        If lnAsistencia = 0 Then
			Insert Into asistencia (user_key,  date_,      time_in)
                            Values (lnUserKey, curdate(), curtime());
        End If;
        Select lnAsistencia, user_key, type, name, user, password, date_register, last_modify, status, branch_key, no_employe
          From user
		 Where user=pUser
		   And password=sha1(pPass);
    End If;
 
END $$
DELIMITER ;
/
