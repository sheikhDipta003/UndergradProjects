//! GETTERS & SETTERS
import 'student.dart';

void main(){
var student = Student(1, 'Dipta', 89);
print('Student name is ${student.username}\nIs him smart ${student.isStudentSmart}');

student.studentNewName = 'Mario';
print('Student name is ${student.username}\nIs him smart ${student.isStudentSmart}');

}