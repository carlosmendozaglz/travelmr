Create Or Replace View Vw_Travels As

	Select t.travel_key,     t.location,     t.description,   
           date_format(t.date_departure,'%d/%m/%Y') date_departure, 
           date_format(t.date_return,'%d/%m/%Y') date_return, 
		   t.time_departure, t.time_return,  t.date_register, t.last_modify,    t.adult_price, 
		   t.minor_price,    t.infant_price, t.days,          t.nigth,          
		   t.restaurant_key, r.name restaurant_name,
		   t.hotel_key,      h.name hotel_name,
		   t.airline_key,    a.airline_name, 
		   t.coments, 
           date_format(t.last_day_pay,'%d/%m/%Y') last_day_pay, 
           t.percent, 
		   t.notes,          t.miles,        t.key_
	  From travel t, restaurant r, airline a, hotel h
	 Where t.restaurant_key=r.restaurant_key
	   And t.airline_key=a.airline_key
	   And t.hotel_key=h.hotel_key
;