/*
 * Author:Abdelaziz El Ouastani
*/
class ClassSup{}
class Cast extends ClassSup{}
public class ClassCastExc{
	public static void main(String[] args){
		//ClassCastException
		Cast ejemplo= (Cast)new ClassSup();
	}
}
