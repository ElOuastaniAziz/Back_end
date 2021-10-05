/*
 * Author:Abdelaziz El Ouastani
*/
class IllegalStateExc{
	public static void conectar(boolean connected) {
		if (connected)
        throw new IllegalStateException("Already connected");
	}	
	public static void main(String[] args){
	
		//IllegalStateException 
		boolean connected=true;
		conectar(connected);
	}
}
