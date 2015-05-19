for (var i = 0; i < methodsArray.length; i++){
				 		var object = methodsArray[i];
				 		for(var key in object){
				 			var methodName = key;
				 			var methodValue = object[key];
				 			switch(methodName){
				 				case 'id':
				 				$("<td><input type ='checkbox' value = '"+methodValue+"' </td>").appendTo(".testr");
				 			}
				 		}
				 	}