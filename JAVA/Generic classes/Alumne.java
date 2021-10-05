import java.util.*;
class Alumne extends Persona3 implements Comparable<Alumne>{
	@Override 
	public boolean  equals(Object obj){
			if(obj==null) return false;
			if(obj==this)return true;
			if(dni.compareTo(((Persona3)obj).dni)==0)return true;
			if(!(obj instanceof Persona3)) return false;
			return (dni.equals(((Persona3)obj).dni));
	}
	int compareTo(){
		
		return 0;
	}
	//declaracion de variables
	private char nivell='?';
	//Declaracion de contructores
	/** Valores validos:
	 * B
	 * M
	 * S
	 * ?
	 * /
	 *  */
	 public Alumne(){}
	 public Alumne (String ndni, String nnom, int nedat, char nnivell){
		super(ndni, nnom, nedat);
		nivell = validarNivell(nivell);
	}
	public Alumne(Persona3 p, char nnivell){
		super(p);
		nivell = validarNivell(nnivell);
	}
	public Alumne(String ndni, String nnom, int nedat){
		this(ndni, nnom, nedat, '?');
	}
	public Alumne(Alumne a){
		this(a.dni, a.nom, a.edat, a.nivell);
	}
	//Declaracion de metodos
	public void setNivell(char nnivell){
		nivell = validarNivell(nnivell);
	}
	
	private char validarNivell(char nivell){
		nivell= Character.toUpperCase(nivell);
		if(nivell !='B' && nivell !='M')nivell='?';
		return nivell;
	}
	public char getNivell(){return nivell;}
		//Restrictura de metodos
	public Alumne  clonar(){return  new Alumne(this);}
	public String toString(){
		String s = ("Dni: "+dni+" - Nom: "+nom+" -Edat"+edat+" nivell: ");
		switch(nivell){
			case 'B': s= s+"Batxillerat"; break;
			case 'M': s=s+"Cicle F. grau mitja"; break;
			case 'S': s=s+"Cicles F. grau superio "; break;
			default:  s=s+"???";break;
		}
		return s;
	}
	public static void main (String args[]){
		Hashtable<String, Alumne> alumno = new Hashtable<String, Alumne>();
		
		alumno.put("12345639R",new Alumne("12345639R","Juan",54, 'S'));
		alumno.put("12345678A",new Alumne("12345678A","Sara",48, 'B'));
		alumno.put("12345678C",new Alumne("12345678C","Maria",33, 'M'));
		Enumeration clave = alumno.keys();
		Enumeration valor = alumno.elements();
		while(clave.hasMoreElements()){
			System.out.println(clave.nextElement()+" : "+valor.nextElement());
		}
		System.out.println(alumno);
		
		
	}
	
}
