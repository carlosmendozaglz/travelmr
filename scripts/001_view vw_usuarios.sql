create or replace view vw_usuarios as 
select us.user_key, us.type, us.name, us.user, us.password, us.date_register, us.last_modify, us.status, us.branch_key, br.description branch, us.no_employe 
  from user us, branch br 
 where us.branch_key=br.branch_key ;
