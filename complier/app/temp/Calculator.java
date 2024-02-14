public class Calculator {
    public static void main(String[] args) {
        int a = 0;
        int b = 5;
        Calculator calculator = new Calculator();
        int sum = calculator.add(a, b);
        System.out.println("The sum of " + a + " and " + b + " is " + sum + ".");
    }

    public int add(int num1, int num2) {
        return num1 + num2;
    }
}