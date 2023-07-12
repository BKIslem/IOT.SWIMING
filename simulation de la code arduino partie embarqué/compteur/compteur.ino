#include <Wire.h>
#include <LiquidCrystal_I2C.h>

// Set the LCD address to 0x27 for a 16 chars and 2 line display
LiquidCrystal_I2C lcd(0x27, 20, 4);
#define Btn 2
#define Led_R 7
#define Led_O 6
#define Led_G 5
#define Buzzer 4

#define Is_Stopped  0
#define Is_Counting 1

//#define Test;

unsigned long start = millis();
unsigned long compteur = 0;
unsigned long MS;
uint8_t Btn_Status_New = 0;
uint8_t Btn_Status_Old = 0;
uint8_t Counter_Status = 0;
uint8_t position_horloge = 4;

int Clock = 0 ; 
int number = 0;
int Minutes = 0;
int Seconds = 0;
int Milliseconds=0;
unsigned long previousMillis = 0;
#ifdef Test       
   long interval = 100; 
#else  
   long interval = 1000;
#endif

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  lcd.init();
  lcd.clear();
  pinMode(Btn, INPUT_PULLUP);

  lcd.backlight();
  lcd.clear();
  lcd.setCursor(3, 0);
  lcd.print("PROGRAMME DE JOUR");
  lcd.setCursor(3, 1);
  lcd.print("4x100m crawl");
  lcd.setCursor(3, 2);
  lcd.print("4x200m 4nages");
  lcd.setCursor(3, 3);
  lcd.print("4x400m Dos");
  //delay(1500);
}


void loop() {
unsigned long currentMillis = millis();

  Btn_Status_New = !digitalRead(Btn);
  delay (300);
  if(Btn_Status_New && !Btn_Status_Old)
  {
    if(Counter_Status == Is_Stopped)
    {
      Counter_Status = Is_Counting;
      //Rajouter Animation de départ
      
        digitalWrite(Led_G,LOW);
      for ( int i = 0 ; i <= 1 ; i++ ) {
     
       digitalWrite(Led_R,HIGH);
       digitalWrite(Buzzer, HIGH);
        delay (300);
        digitalWrite(Led_R,LOW);
        digitalWrite(Buzzer, LOW);
        delay (300);
      
      
      }
      
      //fin animation de départ
      lcd.clear();
      start = millis();
      previousMillis = currentMillis;
      Serial.print("Fonction Millis() : ");
      Serial.println(MS);
      Serial.print("variable start : ");
      Serial.println(start);
      //Rajouter Animation de départ suite
       digitalWrite(Led_R,LOW);
      digitalWrite(Led_G,HIGH);
      digitalWrite(Buzzer, HIGH);
      delay(100);
      digitalWrite(Buzzer, LOW);
      
      
      //fin animation de départ
       
    }
    else //if(Counter_Status == Is_Counting)
    {
      lcd.clear();
      Counter_Status = Is_Stopped;
      MS = millis();
      Clock = (MS - start) / 1000;
      Minutes = Clock/60;
      Seconds = Clock % 60;
      Milliseconds = (MS - start) % 100;

      Serial.println("Temps final : ");
      Serial.print(Minutes);
      Serial.print(":");
      Serial.print(Seconds);
      Serial.print(":");
      Serial.println(Milliseconds);
      Serial.print("Fonction Millis() : ");
      Serial.println(MS);
      Serial.print("variable start : ");
      Serial.println(start);
      //position_horloge++;
      char timess[16]="";
      sprintf(timess,"%02d:%02d:%02d",Minutes,Seconds,Milliseconds);
       lcd.print(timess);
       }
  }
  
  if(Counter_Status == Is_Counting && currentMillis - previousMillis >= interval)
  {
      previousMillis = currentMillis;
      MS = millis();
      Clock = (MS - start) / 1000;
      Minutes = Clock/60;
      Seconds = Clock % 60;
      Milliseconds = (MS - start) % 100;
       char times[16]="";
      sprintf(times,"%02d:%02d:%02d",Minutes,Seconds,Milliseconds);
      lcd.setCursor(3, 0);
      lcd.print(times);
      
      Serial.println("Compteur : ");
      Serial.print(Minutes);
      Serial.print(":");
      Serial.print(Seconds);
      Serial.print(":");
      Serial.println(Milliseconds);
  }
  Btn_Status_Old = Btn_Status_New;
}

void UpdateDisplay()
{
  
}
