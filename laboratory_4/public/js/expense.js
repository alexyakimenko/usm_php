const addPersonBtn = document.querySelector("#add-person")
const people = document.querySelector("#people")

addPersonBtn.addEventListener('click', (e) => {
    e.preventDefault()
    const label = document.createElement("label")
    label.innerHTML = `<input class="border border-gray-300 p-2 w-full" type="text" name="people[]" placeholder="Имя участника">`

    people.appendChild(label)
})