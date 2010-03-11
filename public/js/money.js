
	var changeArray = new Array();
	
	originalAmount = 0;
	
	function makeChange(money) {
		/* let's initialize things back to zero and
		   set the original amount to money for nice
		   output */
		if (originalAmount==0) {
			originalAmount = money;
			changeArray['quarters'] = 0;
			changeArray['dimes'] = 0;
			changeArray['nickels'] = 0;
			changeArray['pennies'] = 0;
		}
		
		money = Math.round(money*100)/100;
		/* Too much recursion on huge numbers and we will stop the browser from finishing
		   so only do recursion on the cents and do division on the dollars */
		if (money > Number(1.00)) {
			dollars = parseInt(money);
			money = parseFloat(money)-dollars; /* now cents */
			changeArray['quarters'] += dollars/.25;
		}
		
		/* javascript doesn't do subtraction right so
		   get 2 places past the decimal */
		money = Math.round(money*100)/100;

		if (money!=Number(0)) {
			if (money > .25) {
				changeArray['quarters'] += 1;
				money -= .25;
			} else if (money >= .10) {
				changeArray['dimes'] += 1;
				money -= .10;
			} else if (money >= .05) {
				changeArray['nickels'] += 1;
				money -= .05;
			} else if (money >= .01) {
				changeArray['pennies'] += 1;
				money -= .01;
			}
			return makeChange(money);
		}
		
		
		/* Finally, output */
		str = "Your change for $" + originalAmount + " is ";
		
		/* Create the correct grammar */
		for (var k in changeArray) {
			str += changeArray[k] + " " +
			(changeArray[k]==1 ? singularize(k) : k);
			
			if (k!='pennies')
				str += (k!='nickels' ? ', ' : ' and ');
		}
		
		/* set the original ammount back to 0 in case
		   they click the button again */
		originalAmount = 0;
		
		return str;
	}
	
	/* singularize the names for good grammar */
	function singularize(phrase) {
		if (phrase.slice(-3,phrase.length)=='ies') {
			return phrase.slice(0,-3) + 'y';
		} else {
			return phrase.slice(0,-1);
		}
	}

	$(window).load(
		function() {
			$('#money_form').submit(
				function () {
					val = $('#money').val();
					if (val=='') {
						$('#results').html("Ooops! You didn't enter a value.");
					} else {
						$('#results').html(makeChange(val));
					}
					return false;
				}
			);
		}
	);