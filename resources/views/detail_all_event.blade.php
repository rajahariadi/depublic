<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DETAIL TIKET</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
    
    @include('layout.navbar')

    <div class="container">
        <div class="button-container mt-3">
            <button type="button" class="btn btn-link text-dark">Home</button>
            <img src="assets/image/chevron-compact-right.svg" alt="Home Icon" class="icon">
            <button type="button" class="btn btn-link text-purple">Ticket</button>
        </div>
        <div class="d-flex justify-content-between">
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="Search Activities">
                <svg class="search-icon svg-icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.442 1.4a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z"/>
                </svg>
            </div>
            <div class="location-container">
                <button type="button" class="location-button" placeholder="Location"> 
                    <span>Location</span> 
                    <svg class="chevron-down-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-down" viewBox="0 0 16 16">
                        <path d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67"/>
                    </svg>
                    <svg class="location-icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16"> 
                        <path d="M8 0a5.53 5.53 0 0 0-5.53 5.53c0 3.072 4.053 9.238 4.655 10.005a.525.525 0 0 0 .751 0c.602-.767 4.655-6.933 4.655-10.005A5.53 5.53 0 0 0 8 0Zm0 7.579a2.03 2.03 0 1 1 0-4.059 2.03 2.03 0 0 1 0 4.058Z"/> 
                    </svg>
                </button>
            </div>
        </div>
        <div class="events-and-buttons">
            <div class="all-event-text">
                All Events
            </div>
            <div class="button-size">
                <button type="button" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="purple" class="bi bi-filter-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path d="M6 11.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
                    </svg>
                    Filter
                </button>
                <button type="button" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="purple" class="bi bi-calendar" viewBox="0 0 16 16">
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                    </svg>
                    Date
                </button>
                <button type="button" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="purple" class="bi bi-tag" viewBox="0 0 16 16">
                        <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0"/>
                        <path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1m0 5.586 7 7L13.586 9l-7-7H2z"/>
                    </svg>
                    Price
                </button>
            </div>
        </div>
        <hr>
        <div class="separator"></div>
        <div class="event-results">
            <span class="fw-bold">60 Results</span> All Events
        </div>        
        <div id="cardsContainer" class="mt-4 d-flex flex-wrap justify-content-between">
            <div class="card" style="width: 16rem;">
                <img src="{{ asset('assets/image/Card 1.jpg') }}" class="card-img-top" alt="Placeholder Image 1">
                <div class="card-body">
                    <p class="card-text">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        <span>BANDUNG | <span class="date-text">DAY, MON TANGGAL</span></span>
                    </p>
                    <h2 class="fw-bold" style=" font-family:'Montserrat', sans-serif; font-size:20px;">Judul Event</h2>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <p class="card-text"><span class=" fw-bold date-text" style=" font-family:'Montserrat', sans-serif; font-size:20px;">IDR 1.999.000</span>/1 Person</p>
                    <button class="btn available-button">Tersedia</button>
                </div>
            </div>

            <div class="card" style="width: 16rem;">
                <img src="{{ asset('assets/image/Card 1.jpg') }}" class="card-img-top" alt="Placeholder Image 1">
                <div class="card-body">
                    <p class="card-text">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        <span>BANDUNG | <span class="date-text">DAY, MON TANGGAL</span></span>
                    </p>
                    <h2 class="fw-bold" style=" font-family:'Montserrat', sans-serif; font-size:20px;">Judul Event</h2>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <p class="card-text"><span class=" fw-bold date-text" style=" font-family:'Montserrat', sans-serif; font-size:20px;">IDR 1.999.000</span>/1 Person</p>
                    <button class="btn available-button">Tersedia</button>
                </div>
            </div>

            <div class="card" style="width: 16rem;">
                <img src="{{ asset('assets/image/Card 1.jpg') }}" class="card-img-top" alt="Placeholder Image 1">
                <div class="card-body">
                    <p class="card-text">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        <span>BANDUNG | <span class="date-text">DAY, MON TANGGAL</span></span>
                    </p>
                    <h2 class="fw-bold" style=" font-family:'Montserrat', sans-serif; font-size:20px;">Judul Event</h2>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <p class="card-text"><span class=" fw-bold date-text" style=" font-family:'Montserrat', sans-serif; font-size:20px;">IDR 1.999.000</span>/1 Person</p>
                    <button class="btn available-button">Tersedia</button>
                </div>
            </div>

            <div class="card" style="width: 16rem;">
                <img src="{{ asset('assets/image/Card 1.jpg') }}" class="card-img-top" alt="Placeholder Image 1">
                <div class="card-body">
                    <p class="card-text">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        <span>BANDUNG | <span class="date-text">DAY, MON TANGGAL</span></span>
                    </p>
                    <h2 class="fw-bold" style=" font-family:'Montserrat', sans-serif; font-size:20px;">Judul Event</h2>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <p class="card-text"><span class=" fw-bold date-text" style=" font-family:'Montserrat', sans-serif; font-size:20px;">IDR 1.999.000</span>/1 Person</p>
                    <button class="btn available-button">Tersedia</button>
                </div>
            </div>

            <div class="card" style="width: 16rem;">
                <img src="{{ asset('assets/image/Card 1.jpg') }}" class="card-img-top" alt="Placeholder Image 1">
                <div class="card-body">
                    <p class="card-text">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        <span>BANDUNG | <span class="date-text">DAY, MON TANGGAL</span></span>
                    </p>
                    <h2 class="fw-bold" style=" font-family:'Montserrat', sans-serif; font-size:20px;">Judul Event</h2>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <p class="card-text"><span class=" fw-bold date-text" style=" font-family:'Montserrat', sans-serif; font-size:20px;">IDR 1.999.000</span>/1 Person</p>
                    <button class="btn available-button">Tersedia</button>
                </div>
            </div>
            
            <div class="card" style="width: 16rem;">
                <img src="{{ asset('assets/image/Card 1.jpg') }}" class="card-img-top" alt="Placeholder Image 1">
                <div class="card-body">
                    <p class="card-text">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        <span>JAKARTA | <span class="date-text">DAY, MON TANGGAL</span></span>
                    </p>
                    <h2 class="fw-bold" style=" font-family:'Montserrat', sans-serif; font-size:20px;">Judul Event Baru 1</h2>
                    <p>Deskripsi event baru 1.</p>
                    <p class="card-text"><span class=" fw-bold date-text" style=" font-family:'Montserrat', sans-serif; font-size:20px;">IDR 2.999.000</span>/1 Person</p>
                    <button class="btn available-button">Tersedia</button>
                </div>
            </div>
            
            <div class="card" style="width: 16rem;">
                <img src="{{ asset('assets/image/Card 1.jpg') }}" class="card-img-top" alt="Placeholder Image 1">
                <div class="card-body">
                    <p class="card-text">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        <span>JAKARTA | <span class="date-text">DAY, MON TANGGAL</span></span>
                    </p>
                    <h2 class="fw-bold" style=" font-family:'Montserrat', sans-serif; font-size:20px;">Judul Event Baru 2</h2>
                    <p>Deskripsi event baru 2.</p>
                    <p class="card-text"><span class=" fw-bold date-text" style=" font-family:'Montserrat', sans-serif; font-size:20px;">IDR 3.999.000</span>/1 Person</p>
                    <button class="btn available-button">Tersedia</button>
                </div>
            </div>
            
            <div class="card" style="width: 16rem;">
                <img src="{{ asset('assets/image/Card 1.jpg') }}" class="card-img-top" alt="Placeholder Image 1">
                <div class="card-body">
                    <p class="card-text">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        <span>JAKARTA | <span class="date-text">DAY, MON TANGGAL</span></span>
                    </p>
                    <h2 class="fw-bold" style=" font-family:'Montserrat', sans-serif; font-size:20px;">Judul Event Baru 3</h2>
                    <p>Deskripsi event baru 3.</p>
                    <p class="card-text"><span class=" fw-bold date-text" style=" font-family:'Montserrat', sans-serif; font-size:20px;">IDR 4.999.000</span>/1 Person</p>
                    <button class="btn available-button">Tersedia</button>
                </div>
            </div>

            <div class="card" style="width: 16rem;">
                <img src="{{ asset('assets/image/Card 1.jpg') }}" class="card-img-top" alt="Placeholder Image 1">
                <div class="card-body">
                    <p class="card-text">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        <span>JAKARTA | <span class="date-text">DAY, MON TANGGAL</span></span>
                    </p>
                    <h2 class="fw-bold" style=" font-family:'Montserrat', sans-serif; font-size:20px;">Judul Event Baru 3</h2>
                    <p>Deskripsi event baru 3.</p>
                    <p class="card-text"><span class=" fw-bold date-text" style=" font-family:'Montserrat', sans-serif; font-size:20px;">IDR 4.999.000</span>/1 Person</p>
                    <button class="btn available-button">Tersedia</button>
                </div>
            </div>
            
        </div>    
    </div>

    @include('layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybRigk8aCJmSKxbw8eS5RBVRhkVV7Qz2ym1Lv4sfWn3w4pZl8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-wEmeIV1mKuiNp1xg6KO9g5qLAyvoRMz4lFlnZVmgJIm3twTSTQRvf0PY1RZh4iJ2" crossorigin="anonymous"></script>
</body>
</html>
