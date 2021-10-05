 abstract class Publicacio{
		//declaramos los atributos
		protected String titol;
		protected  String isbn;
		protected  boolean publicat;
		//los constructores
		public Publicacio(){}
		public Publicacio(Publicacio pub){
			this(pub.titol,pub.isbn,pub.publicat);
		}
		public Publicacio(String titol,String isbn, boolean publicat){
				this.titol=titol;
				this.isbn=isbn;
				this.publicat=publicat;
		}
		//Método equals
		@Override 
		public boolean  equals(Object obj){
				if(obj==null) return false;
				if(obj==this)return true;
				if(!(obj instanceof Publicacio)) return false;
				return (getIsbn().equals(((Publicacio)obj).getIsbn()));
		}
		//Método toString 
		@Override 
		public String toString(){
				return "titol \'"+getTitol()+"\' i isbn "+getIsbn()+" esta publicat? "+isPublicat();
		}
		//Getters
		public String getTitol(){return titol;}
		public String getIsbn(){return isbn;}
		public boolean isPublicat(){return publicat;}
	
}
// libro es una subclase de la clase de Publicaci
class Llibre extends Publicacio{
		//constructores
		public Llibre (){}
		public Llibre(String titol, String isbn, boolean publicat){
			super(titol, isbn, publicat);
		}
		public Llibre(Llibre llib){
			this(llib.titol, llib.isbn, llib.publicat);
		}
		//Método toString
		@Override 
		public String toString(){
				return super.toString();
		}
		//Método equals
		@Override 
		public boolean equals(Object ob){
				return super.equals(ob);
		} 
	
}
//// Revista es una subclase de la clase de Publicaci
class  Revista extends Publicacio{
	//constructores
		public Revista(){}
		public Revista(String titol,String isbn, boolean publicat){
				super(titol, isbn, publicat);
		}
		public Revista(Revista rev){
			this(rev.titol, rev.isbn,rev.publicat);
		}
		//Método toString
		@Override 
		public String toString(){
				return super.toString();
		}
		////Método equals
		@Override 
		public boolean equals(Object ob){
				return super.equals(ob);
		} 
			
			
}
//clase usuari tiene un método que hace de puente entre las subclases y la clase superior
 class Usuari{ 
		 String consutla(Publicacio ob){
			return ob.toString();
		}
	
}

//clase para test contiene el main del programa.
public class AbdelazizElOuastani{
		public static void main(String args[]){
			Revista revista1 = new Revista("Python","1233A",true);
			Publicacio libro1 = new Llibre("Python","1233a",true);
			Usuari test = new Usuari();
			System.out.println(test.consutla(revista1));
			System.out.println(test.consutla(libro1));
			System.out.println("¿El libro1 y la revista1 son iguals? "+libro1.equals(revista1));
		}
}
