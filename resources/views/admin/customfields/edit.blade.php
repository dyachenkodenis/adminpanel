  <div class="container">
          <form id="treb" action="/treb" method="post">
          
            @csrf()
            @method('POST')

            <div class="mb-3">
                <label class="form-label">text</label>
                <input type="text" name="text" class="form-control" >
            </div>
            <div class="col-auto">
                <button type="submit" id="save" class="btn btn-primary mb-3">Отправить</button>
            </div>
            <div id="result"></div>
          </form>
        </div>

       <script>
        document.getElementById("treb").addEventListener("submit", function(event) {
            event.preventDefault(); 

            console.log(event);
            var formData = new FormData(this);

            fetch('/treb', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById("result").innerText = data.message;
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
        });
    </script>