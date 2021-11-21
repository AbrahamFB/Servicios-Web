import { getDatabase } from "firebase/https://prueba-ff886-default-rtdb.firebaseio.com/";

const database = getDatabase();

const taskFrom = document.querySelector('#task-from');
taskFrom.addEventListener('setUser', e => {
    console.log('submiting')
})