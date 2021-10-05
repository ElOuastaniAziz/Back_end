package figuras;
import java.awt.Color;
// Subclase Rectangulo
public class Rectangulo extends FiguraGeometrica{
	//declaración de atributos del cuadrado
	private double altura;
	private double base;
	//declaracion de constructor 
	public Rectangulo(){}
	public Rectangulo(double alura, double base){ 
		this.altura=altura;
		this.base=base;	
	}
	// Constructores con variables locales y de superclase
	public Rectangulo(int codigo, String nom, Color color, double altura, double base){
		super(codigo,nom, color);
		this.altura=altura;
		this.base=base;
	}
	//SETTERS
	public void setAltura(double altura){this.altura=altura;}
	//GETTERS
	public double getAltura(){
		return altura;
	}
	//// Método perímetro
	@Override
	public double perimetro(){
		double p=2*(altura+base);
		return p;		
	}
	// Método area
	@Override
	public double area(){
		return altura*base;
	}
	//método toString
	@Override 
	public String toString(){
		return base+" "+altura;
	}
	//método hashCode
	@Override 
	public int hashCode(){
		final int prime = 31;
		int result = 1;
		result = prime * result +(int)altura+(int)base;
		return result;
	} 
	//método equals
	@Override 
	public boolean equals(Object obj){
		boolean igual=false;
		if(obj instanceof Rectangulo){
			Rectangulo  rec = (Rectangulo)obj;
			if(this.base==rec.base && this.altura==rec.altura){
				igual=true;
			}
		} 
		return igual;
	} 
}
