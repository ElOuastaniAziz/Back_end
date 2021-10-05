/*
 * Author:Abdelaziz El Ouastani
*/
import java.lang.IllegalArgumentException;

class IllegalArgumentException1{
	public static void getPrice(double d) throws IllegalArgumentException {
		if(d <= 0) {
          throw new IllegalArgumentException(" el numero no puede ser menor o igual a 0");
		}
	}
	public static void main(String[] args){
		//IllegalArgumentException
		getPrice(0);	
	}
}
