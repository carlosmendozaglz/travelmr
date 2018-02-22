DROP PROCEDURE IF EXISTS p_Logout;
DELIMITER $$
 
CREATE PROCEDURE p_Logout(
    IN  pUserKey    Int)
BEGIN
    DECLARE lvName   Varchar(200) DEFAULT '';
    DECLARE lv   Varchar(200) DEFAULT '';
    Declare lnUserKey    Int;
    Declare lnAsistencia Int;
	
    Set lnAsistencia = Ifnull((Select asistencia_key
								 From asistencia
								Where date_=curdate()
								  And user_key=pUserKey), 0);
		
	If lnAsistencia = 0 Then
	    Select 1 success,'No se encontó sesión aciva.' message;
	ElseIf lnAsistencia > 0 Then
		Update asistencia
           Set time_out=curtime()
		 Where asistencia_key=lnAsistencia;
		Select 1 success, 'Saliendo ... ' message;
	Else
		Select lnAsistencia success, 'Else ' message;
	End If;

END $$
DELIMITER ;
