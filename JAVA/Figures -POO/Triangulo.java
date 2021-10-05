package figuras;
import java.awt.Color;
// Subclase Triangulo
public class Triangulo extends FiguraGeometrica{
	//declaración de atributos del cuadrado
	private double altura;
	private double base;
	private double lado1;
	private double lado2;
	//declaracion de constructor
	public Triangulo(){}
	public Triangulo(double alura, double lado1, double lado2){ 
		this.altura=altura;
		this.lado1=lado1;
		this.lado2=lado2;
	}
	// Constructores con variables locales y de superclase
	public Triangulo(int codigo, String nom, Color color, double altura,double lado1, double lado2){
		super(codigo,nom, color);
		this.altura=altura;
		this.base=base;
		this.lado1=lado1;
		this.lado2=lado2;
	}
	//SETTERS
	void setAltura(double altura){this.altura=altura;}
	void setLado1(double lado1){this.lado1=lado1;}
	void setLado2(double lado2){this.lado2=lado2;}
	//GETTERS
	double getAltura(){	return altura;}
	double getLado1(){return lado1;}
	double getLado2(){return lado2;}
	//// Método perímetro
	@Override
	public double perimetro(){
		return altura+lado1+lado2;		
	}
	//Método area
	@Override
	public double area(){
		double p= (altura+lado1+lado2)/2;
		//double p2=p*(p-altura)*(p-lado1)*(p-lado2);
		return Math.sqrt(p*(p-altura)*(p-lado1)*(p-lado2));
	}
	//método toString
	@Override 
	public String toString(){
		return altura+" "+lado1+" "+lado2;
	}
	//método hashCode
	@Override 
	public int hashCode(){
		final int prime = 31;
		int result = 1;
		result = prime * result +(int)altura+(int)lado1+(int)lado2;
		return result;
	} 
	//método equals
	@Override 
	public boolean equals(Object obj){
		boolean igual=false;
		if(obj instanceof Triangulo){
			Triangulo  tria = (Triangulo)obj;
			if(this.altura==tria.altura && this.lado1==tria.lado1 && this.lado2==tria.lado2){
				igual=true;
			}
		} 
		return igual;
	} 
		
}	
