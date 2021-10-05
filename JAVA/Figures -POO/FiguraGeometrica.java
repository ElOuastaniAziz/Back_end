package figuras;
import java.awt.Color;
public abstract class FiguraGeometrica{
	//declararión de atributos
	private int codigo;
	private String nom;
	private Color color;
	//declaración de constructores
	public FiguraGeometrica(){}
	public FiguraGeometrica(int codigo, String nom,Color color){
		this.codigo = codigo;
		this.nom=nom;
		this.color=color;
	}
	public FiguraGeometrica(FiguraGeometrica copia){
		this(copia.codigo, copia.nom, copia.color);
	}
	//SETTERS
	public void setCodigo(int codigo){
		this.codigo=codigo;
	}
	public void setNom(String nom){
		this.nom=nom;
	}
	public void setColor(Color color){
		this.color=color;
	}
	//GETTERS
	public int getCodigo(){ return codigo;}
	public String getNom(){return nom;}
	public Color getColor(){ return color;}
	//Método visualizar
	public void visualizar(){
		System.out.println(" la figura actual es "+nom+ " su cófdigo es "+codigo+" y su color "+color);
	}
		////// Método perímetro
	public abstract double perimetro();
	// Método area
	public abstract double area();
	
	
}
