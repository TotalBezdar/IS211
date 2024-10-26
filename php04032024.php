<?php
// class Student  
// {
//     public string $name;
//     public int $age;
//     public string $course;
//     public function __construct(string $name, int $age, string $course)
//     {
//         $this->name = $name;
//         $this->age = $age;
//         $this->course = $course;
//     }
//     public function serialize ()
//     {
//       return serialize([$this->name, $this->age, $this->course]);
//     }
//     public function unserialize ($data)
//     {
//         [$this->name, $this->age, $this->course] = unserialize($data);
//     }
// }
// $student = new Student("Виталий", 18, "ИС-211");
// $serializedData = $student->serialize();

// $restoredStudent = new Student("", 0, "");
// $restoredStudent->unserialize($serializedData);

// echo "Востановленны студент: Имя - {$restoredStudent->name}, Возраст - {$restoredStudent->age}, Курс - {$restoredStudent->course}";

// interface FileStorageInterface 
// {
//     public function saveData($obj);
//     public function loadData():mixed;
// }
// class FileStorage implements FileStorageInterface
// {
//     const NAME_FILE = "data.txt";
//     public function saveData($obj)
//     {
//         $data = serialize($obj);
//         file_put_contents(self::NAME_FILE, $data);
//     }
//     public function loadData():mixed
//     {
//         $data = unserialize(file_get_contents(self::NAME_FILE));
//         return $data;
//     }
// }
// $store = new FileStorage();
// $store->saveData(new Student("Андрей", 18, "ИС-211"));
// $student = $store->loadData();
// var_dump($student);

