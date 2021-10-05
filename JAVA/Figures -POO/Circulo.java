package figuras;
import java.awt.Color;
// Subclase circulo
public class Circulo extends FiguraGeometrica{
	//declaración de atributos del circulo
	private final double PI ;
	private double radio;
	//declaracion de constructor circulo
	public Circulo(){
		this.PI=Math.PI;
	}
	public Circulo( double radio){ 
		this.PI=Math.PI;
		this.radio= radio;
	}
	// Constructores con variables locales y de superclase
	public Circulo(int codigo, String nom, Color color, double radio){
		super(codigo,nom, color);
		this.radio=radio;
		this.PI=Math.PI;
	}
	//SETTERS
	public void setRadio(double radio){this.radio=radio;}
	//GETTERS
	public double getRadio(){
		return radio;
	}
	
	////// Método perímetro
	@Override 
	public double perimetro(){
			return 2*PI*radio;		
	}
	// Método area
	@Override
	public double area(){
		return PI * radio*radio;
	}
	//método toString
	@Override 
	public String toString(){
		return radio+" "+PI;
	}
	//método hashCode
	@Override 
	public int hashCode(){
		final int prime = 31;
		int result = 1;
		result = prime * result +(int)radio;
		return result;
	} 
	//método equals
	@Override 
	public boolean equals(Object obj){
		boolean igual=false;
		if(obj instanceof Circulo){
			Circulo  cir = (Circulo)obj;
			if(this.radio==cir.radio){
				igual=true;
			}
		} 
		return igual;
	} 
}
