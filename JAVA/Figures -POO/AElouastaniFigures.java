import java.awt.Color;
import figuras.Triangulo;
import figuras.Circulo;
import figuras.Rectangulo;

public class AElouastaniFigures{
	public static void main(String args[]){
		/*Triangulo tria1 = new Triangulo();
		tria1.setAltura(5);
		tria1.setLado1(6);
		tria1.setLado2(7);
		//tria1.setCodigo(222);
		//tria1.setColor(Color.white);
		tria1.setNom("Triangulo");
		System.out.println(tria1.getCodigo());
		tria1.visualizar();
		System.out.println("PERIM: "+tria1.perimetro()+" cm");
		System.out.println("Area: "+tria1.area()+" cm"); */
		//
		/*Rectangulo cir = new Rectangulo(123,"Rectangulo",null, 5,3); //int codigo, String nom, Color color, double altura, double base){
		//cir.setNom("Círculo");
		//cir.setCodigo(125);
		//cir.setRadio(5.5);
		cir.visualizar();
		System.out.println(cir.perimetro()+" cm");
		System.out.println(cir.area()+" cm");  */
		Triangulo ok = new Triangulo (123,"Rectangulo",null, 3,4,5);
		Triangulo  ok2 = new Triangulo (123,"Rectangulo",null, 3,4,5);
		//ok = ok2;
		if(ok.equals(ok2)){
			System.out.println("Igual");
			System.out.println(ok.hashCode());
			System.out.println(ok2.hashCode());
		}else{
			System.out.println("NO Igual");
			System.out.println(ok.hashCode());
			System.out.println(ok2.hashCode());
			
		}
		System.out.println(ok.area()+" cm");
		
		//int codigo, String nom, Color color, double altura,double lado1, double lado2
	}
	
}
