<?php
    require '../connect.php';
    session_start();
    
    include '../nav.php';
   // include 'fetch-notification.php';
?>

<section class="bg-cover bg-center text-center py-20" style="background-image: url('../Images/bg.jpeg')">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white">Find Your Dream Job Today!</h1>
        <p class="text-white mt-4">Connecting Talent with Opportunity: Your Gateway to Career Success</p>
        <div class="mt-8 flex justify-center space-x-4">
            <input class="px-4 py-2 rounded border border-gray-300" placeholder="Job Title or Company" type="text"/>
            <input class="px-4 py-2 rounded border border-gray-300" placeholder="Select Location" type="text"/>
            <select class="px-4 py-2 rounded border border-gray-300">
                <option value="">Select Category</option>
                <option value="agriculture">Agriculture</option>
                <option value="metal-production">Metal Production</option>
                <option value="commerce">Commerce</option>
                <option value="construction">Construction</option>
                <option value="hotels-tourism">Hotels &amp; Tourism</option>
                <option value="education">Education</option>
                <option value="financial-services">Financial Services</option>
                <option value="transport">Transport</option>
            </select>
            <button id="search-job" class="bg-[rgb(34,197,94)] text-white px-6 py-2 rounded hover:bg-green-600" onclick="window.location.href='worker-list.php'">
                Search Workers
            </button>
            
            
        </div>
        <div class="mt-8 flex justify-center space-x-8 text-white">
            <div class="text-center">
                <div class="text-2xl font-bold">25,850</div>
                <div>Jobs</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold">10,250</div>
                <div>Candidates</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold">18,400</div>
                <div>Companies</div>
            </div>
        </div>
    </div>
</section>
<section class="bg-teal-500 text-white py-12">
    <div class="container mx-auto px-4 flex justify-center space-x-8">
        <!-- <div class="bg-white text-black p-8 rounded shadow-md text-center">
            <h2 class="text-xl font-bold">Jobseeker</h2>
            <p>Looking for a job?</p>
            <button class="bg-[rgb(34,197,94)] text-white px-4 py-2 mt-4 rounded hover:bg-green-600" onclick="window.location.href='jobs.php'">
                Apply Now
            </button>
            
        </div> -->
        <div class="bg-white text-black p-8 rounded shadow-md text-center">
            <h2 class="text-xl font-bold">Recruiter</h2>
            <p>Are You Recruiting?</p>
            <button class="bg-[rgb(34,197,94)] text-white px-4 py-2 mt-4 rounded hover:bg-green-600" onclick="window.location.href='post-a-job.php'">
                Post A Job
            </button>
            
        </div>
    </div>
</section>
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold">Recent Jobs Available</h2>
            <a class="text-teal-500 hover:underline" href="jobs.php">View all</a>
        </div>
        <p class="text-gray-600 mt-2">At eu lobortis pretium tincidunt amet lacus ut aenean aliquet...</p>
        <div class="mt-8 space-y-4">
            <div class="bg-white p-6 rounded shadow-md flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <img alt="Company Logo" class="w-12 h-12 rounded-full" height="50" src="https://storage.googleapis.com/a1aa/image/pPyyFlTBhBLRIVPCTF1jfmnCQyWedZ4wlYxzoLS7MjmuiVCUA.jpg" width="50"/>
                    <div>
                        <div class="text-teal-500 text-sm">10 min ago</div>
                        <div class="text-xl font-bold">Forward Security Director</div>
                        <div class="text-gray-600">Bauch, Schuppe and Schulte Co</div>
                        <div class="flex space-x-2 text-gray-500 mt-2">
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-briefcase"></i>
                                <span>Hotels &amp; Tourism</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-clock"></i>
                                <span>Full time</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-dollar-sign"></i>
                                <span>$40000-$42000</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>New York, USA</span>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="bg-[rgb(34,197,94)] text-white px-4 py-2 rounded hover:bg-green-600" onclick="window.location.href='/job details/index.html'">
                    Job Details
                </button>
                
            </div>
            <div class="bg-white p-6 rounded shadow-md flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <img alt="Company Logo" class="w-12 h-12 rounded-full" height="50" src="https://storage.googleapis.com/a1aa/image/pPyyFlTBhBLRIVPCTF1jfmnCQyWedZ4wlYxzoLS7MjmuiVCUA.jpg" width="50"/>
                    <div>
                        <div class="text-teal-500 text-sm">12 min ago</div>
                        <div class="text-xl font-bold">Regional Creative Facilitator</div>
                        <div class="text-gray-600">Wisozk - Becker Co</div>
                        <div class="flex space-x-2 text-gray-500 mt-2">
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-briefcase"></i>
                                <span>Media</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-clock"></i>
                                <span>Part time</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-dollar-sign"></i>
                                <span>$28000-$32000</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Los Angeles, USA</ span>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="bg-[rgb(34,197,94)] text-white px-4 py-2 rounded hover:bg-green-600" onclick="window.location.href='/job details/index.html'">
                    Job Details
                </button>
                
            </div>
            <div class="bg-white p-6 rounded shadow-md flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <img alt="Company Logo" class="w-12 h-12 rounded-full" height="50" src="https://storage.googleapis.com/a1aa/image/pPyyFlTBhBLRIVPCTF1jfmnCQyWedZ4wlYxzoLS7MjmuiVCUA.jpg" width="50"/>
                    <div>
                        <div class="text-teal-500 text-sm">15 min ago</div>
                        <div class="text-xl font-bold">Internal Integration Planner</div>
                        <div class="text-gray-600">Muzi, Gusikowski and Feest Inc.</div>
                        <div class="flex space-x-2 text-gray-500 mt-2">
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-briefcase"></i>
                                <span>Construction</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-clock"></i>
                                <span>Full time</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-dollar-sign"></i>
                                <span>$48000-$50000</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Texas, USA</span>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="bg-[rgb(34,197,94)] text-white px-4 py-2 rounded hover:bg-green-600" onclick="window.location.href='/job details/index.html'">
                    Job Details
                </button>
                
            </div>
            <div class="bg-white p-6 rounded shadow-md flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <img alt="Company Logo" class="w-12 h-12 rounded-full" height="50" src="https://storage.googleapis.com/a1aa/image/pPyyFlTBhBLRIVPCTF1jfmnCQyWedZ4wlYxzoLS7MjmuiVCUA.jpg" width="50"/>
                    <div>
                        <div class="text-teal-500 text-sm">24 min ago</div>
                        <div class="text-xl font-bold">District Intranet Director</div>
                        <div class="text-gray-600">VonRueden - Weber Co</div>
                        <div class="flex space-x-2 text-gray-500 mt-2">
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-briefcase"></i>
                                <span>Commerce</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-clock"></i>
                                <span>Full time</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-dollar-sign"></i>
                                <span>$42000-$44000</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Florida, USA</span>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="bg-[rgb(34,197,94)] text-white px-4 py-2 rounded hover:bg-green-600" onclick="window.location.href='/job details/index.html'">
                    Job Details
                </button>
                
            </div>
            <div class="bg-white p-6 rounded shadow-md flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <img alt="Company Logo" class="w-12 h-12 rounded-full" height="50" src="https://storage.googleapis.com/a1aa/image/pPyyFlTBhBLRIVPCTF1jfmnCQyWedZ4wlYxzoLS7MjmuiVCUA.jpg" width="50"/>
                    <div>
                        <div class="text-teal-500 text-sm"> 26 min ago</div>
                        <div class="text-xl font-bold">Corporate Tactics Facilitator</div>
                        <div class="text-gray-600">Cormier, Turner and Flatley Inc</div>
                        <div class="flex space-x-2 text-gray-500 mt-2">
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-briefcase"></i>
                                <span>Commerce</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-clock"></i>
                                <span>Full time</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-dollar-sign"></i>
                                <span>$38000-$40000</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Boston, USA</span>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="bg-[rgb(34,197,94)] text-white px-4 py-2 rounded hover:bg-green-600" onclick="window.location.href='/job details/index.html'">
                    Job Details
                </button>
                
            </div>
        </div>
    </div>
</section>
<section class="py-12 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-center">Browse by Category</h2>
        <p class="text-gray-600 text-center mt-2">At eu lobortis pretium tincidunt amet lacus ut aenean aliquet. Blandit a massa elementum id scelerisque...</p>
        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded shadow-md text-center">
                <i class="fas fa-seedling text-teal-500 text-3xl mb-4"></i>
                <h3 class="text-xl font-bold">Agriculture</h3>
                <p class="text-gray-600 mt-2">1254 jobs</p>
            </div>
            <div class="bg-white p-6 rounded shadow-md text-center">
                <i class="fas fa-industry text-teal-500 text-3xl mb-4"></i>
                <h3 class="text-xl font-bold">Metal Production</h3>
                <p class="text-gray-600 mt-2">816 jobs</p>
            </div>
            <div class="bg-white p-6 rounded shadow-md text-center">
                <i class="fas fa-shopping-cart text-teal-500 text-3xl mb-4"></i>
                <h3 class="text-xl font-bold">Commerce</h3>
                <p class="text-gray-600 mt-2">2082 jobs</p>
            </div>
            <div class="bg-white p-6 rounded shadow-md text-center">
                <i class="fas fa-building text-teal-500 text-3xl mb-4"></i>
                <h3 class="text-xl font-bold">Construction</h3>
                <p class="text-gray-600 mt-2">1520 jobs</p>
            </div>
            <div class="bg-white p-6 rounded shadow-md text-center">
                <i class="fas fa-hotel text-teal-500 text-3xl mb-4"></i>
                <h3 class="text-xl font-bold">Hotels &amp; Tourism</h3>
                <p class="text-gray-600 mt-2">1022 jobs</p>
            </div>
            <div class="bg-white p-6 rounded shadow-md text-center">
                <i class="fas fa-graduation-cap text-teal-500 text-3xl mb-4"></i>
                <h3 class="text-xl font-bold">Education</h3>
                <p class="text-gray-600 mt-2">1496 jobs</p>
            </div>
            <div class="bg-white p-6 rounded shadow-md text-center">
                <i class="fas fa-hand-holding-usd text-teal-500 text-3xl mb-4"></i>
                <h3 class="text-xl font-bold">Financial Services</h3>
                <p class="text-gray-600 mt-2">1528 jobs</p>
            </div>
            <div class="bg-white p-6 rounded shadow-md text-center">
                <i class ="fas fa-truck text-teal-500 text-3xl mb-4"></i>
                <h3 class="text-xl font-bold">Transport</h3>
                <p class="text-gray-600 mt-2">1248 jobs</p>
            </div>
        </div>
    </div>
</section>
<section class="py-12">
    <div class="container mx-auto px-4 flex flex-col lg:flex-row items-center">
        <img alt="Company Image" class="w-full lg:w-1/2 rounded shadow-md" height="400" src="https://storage.googleapis.com/a1aa/image/wuz0YT4fDhVULaC56TZv6euK6sYfvGmJEhzYwkUfyeqhVsSgC.jpg" width="600"/>
        <div class="mt-8 lg:mt-0 lg:ml-8">
            <h2 class="text-2xl font-bold">Good Life Begins With A Good Company</h2>
            <p class="text-gray-600 mt-4">Ultrices purus dolor viverra mi scelerisque at mauris justo. Ultrices purus diam egestas amet faucibus tempor blandit. Elit vitae mi mauris aliquam et diam. Leo sagittis consectetur diam mi morbi et aenean. Vulputate praesent congue faucibus in euismod feugiat euismod volutpat...</p>
            <div class="mt-8 flex space-x-4">
                <button class="bg-[rgb(34,197,94)] text-white px-6 py-2 rounded hover:bg-green-600" onclick="window.location.href='worker-list.php'">
                    Search Workers
                </button>
                
                <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300" onclick="window.location.href='../about-us.php'">
                    Learn more
                </button>
            </div>
        </div>
    </div>
</section>
<section class="py-12 bg-gray-100">
    <div class="container mx-auto px-4 text-center">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <div>
                <div class="text-3xl font-bold text-teal-500">12k+</div>
                <div class="text-gray-600 mt-2">Clients worldwide</div>
                <p class="text-gray-500 mt-2">At eu lobortis pretium tincidunt amet lacus ut aenean aliquet. Blandit a massa elementum id scelerisque...</p>
            </div>
            <div>
                <div class="text-3xl font-bold text-teal-500">20k+</div>
                <div class="text-gray-600 mt-2">Active resume</div>
                <p class="text-gray-500 mt-2">At eu lobortis pretium tincidunt amet lacus ut aenean aliquet. Blandit a massa elementum id scelerisque...</p>
            </div>
            <div>
                <div class="text-3xl font-bold text-teal-500">18k</div>
                <div class="text-gray-600 mt-2">Active resume</div>
                <p class="text-gray-500 mt-2">At eu lobortis pretium tincidunt amet lacus ut aenean aliquet. Blandit a massa elementum id scelerisque...</p>
            </div>
            </div>
        </div>
    </div>
</section>
<footer class="bg-black text-white mt-8 p-4">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <h3 class="font-bold">Job</h3>
            <p>Get more information about various job opportunities. Connect with employers and find your dream job.</p>
        </div>
        <div>
            <h3 class="font-bold">Company</h3>
            <ul>
                <li><a class="hover:text-gray-400" href="/about us/index.html">About Us</a></li>
                <li><a class="hover:text-gray-400" href="/contact us/index.html">Contact Us</a></li>
                <li><a class="hover:text-gray-400" href="/home/index.html">Careers</a></li>
                <li><a class="hover:text-gray-400" href="/home/index.html">For Employers</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-bold">Job Categories</h3>
            <ul>
                <li><a class="hover:text-gray-400" href="#">Technology</a></li>
                <li><a class="hover:text-gray-400" href="#">Finance</a></li>
                <li><a class="hover:text-gray-400" href="#">Healthcare</a></li>
                <li><a class="hover:text-gray-400" href="#">Education</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-bold"> Newsletter</h3>
            <p>Subscribe to our newsletter to get the latest job updates.</p>
            <input class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Enter your email" type="email"/>
            <button class="w-full bg-green-500 text-white px-4 py-2 rounded mt-2 hover:bg-green-400" onclick="subscribeNewsletter()">
                Subscribe Now
            </button>
        </div>
    </div>
    <div class="text-center mt-4">
        <p>© 2023 Job Portal. All rights reserved.</p>
        <div class="space-x-4">
            <a class="hover:text-gray-400" href="#">Privacy Policy</a>
            <a class="hover:text-gray-400" href="#">Terms &amp; Conditions</a>
        </div>
    </div>
</footer>
<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        var menu = document.getElementById('mobile-menu');
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
        } else {
            menu.classList.add('hidden');
        }
    });

    // document.getElementById('search-job').addEventListener('click', function() {
    //     window.location.href = '/jobs/index.html';
    // });

    function subscribeNewsletter() {
        // Add your subscription logic here
        alert('Thank you for subscribing to our newsletter!');
    }
</script>
</body>
</html>