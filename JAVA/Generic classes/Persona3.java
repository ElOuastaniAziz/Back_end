abstract public class Persona3 implements Comparable<Persona3>{
	//declaracion de datos
	protected String dni;
	protected String nom;
	protected short edat;
	//declaracion de constructores
	public Persona3(){};
	public Persona3(String dni, String nom, int edat){
		this.dni=dni;
		this.nom=nom;
		if(edat >=0 && edat <= Short.MAX_VALUE)this.edat=(short)edat;
	}
	public Persona3(Persona3 p){
		//emprem la paraula reservada this com  a crida al mateix contructor
		this(p.dni, p.nom,p.edat);
	}
	// metodes de clase
	public abstract Persona3 clonar();
	//Método equals
	@Override 
	public boolean  equals(Object obj){
			if(obj==null) return false;
			if(obj==this)return true;
			if(dni.compareTo(((Persona3)obj).dni)==0)return true;
			if(!(obj instanceof Persona3)) return false;
			return (dni.equals(((Persona3)obj).dni));
	}
	
	
}
