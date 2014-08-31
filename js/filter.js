var Filter = {

	integer: function(value) {
		
		if (!isNaN(value) && (parseInt(value) == value)) {
			return value;
		}
		return null;
	},
	
	natural: function(value) {
		
		if (!isNaN(value) && (parseInt(value) == value) && (value >= 0)) {
			return value;
		}
		return null;
	},

	idNum: function(value) {
		
		var matches														= value.match(/^(\d{2})(\d{2})(\d{2})\d{7}$/);
		if (is_array(matches)) {

			if (matches.length == 4) {

				var year												= matches[1];
				var month												= matches[2];
				var day													= matches[3];
				
				// Check that the date is valid
				if (checkdate(month, day, year)) {

					// Check the control digit
	                var a												= 0;
	                var b												= 0;
	                var c												= 0;
	                var d												= -1;

	                for (i=0; i<6; i++) {
	                	a												+= parseInt(substr(value, i*2, 1));
	                }

	                for (i=0; i<6; i++) {
	                	b												= b * 10 + parseInt(substr(value, (2*i)+1, 1));
	                }

	                b													*= 2;

	                while (b > 0) {
	                	c												= c + (Math.floor(b) % 10);
	                	b												= b / 10;
	                }

	                c													+= a;
	                d													= 10 - (Math.floor(c) % 10);
	                
	                if (d == 10) {
	                	d												= 0;
	                }

	                if (d == substr(value, strlen(value)-1, 1)) {
	                	return value;
	                }
				}
			}
		}
		return null;
	},
	
	nonEmpty: function(value) {
		if (isset(value)) {
			if (value.length != 0) {
				return value;
			}
		}
		return null;
	},
	
	isBlank: function(value) {
		if (isset(value)) {
			if (value.length == 0) {
				return true;
			}
			return false;
		}
		return true;
	}
		
}