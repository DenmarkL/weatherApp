<template>
  <div class="relative" ref="searchContainer">
    <Input
      id="search"
      type="text"
      placeholder="Search Location"
      v-model="query"
      @input="fetchSuggestions"
      class="pl-10"
    />
    <span class="absolute start-0 inset-y-0 flex items-center justify-center px-2">
      <Icon name="hugeicons:search-01"></Icon>
    </span>
    <ul
      v-if="showSuggestions && suggestions.length"
      class="absolute text-black bg-white border border-gray-300 mt-1 w-full z-10 max-h-40 overflow-y-auto"
    >
      <li
        v-for="(suggestion, index) in limitedSuggestions"
        :key="index"
        @click="handleSuggestionClick(suggestion)"
        class="cursor-pointer p-2 hover:bg-gray-100"
      >
        {{ suggestion.name }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      query: '',
      suggestions: [],
      showSuggestions: false,
      weatherData: null,
      suggestionCache: {}, 
      weatherCache: {}, 
    };
  },
  computed: {
    limitedSuggestions() {
      return this.suggestions.slice(0, 5);
    },
  },
  methods: {
    async fetchSuggestions() {
      const trimmedQuery = this.query.trim();

      if (trimmedQuery.length < 3) {
        this.suggestions = [];
        this.showSuggestions = false;
        return;
      }

      if (this.suggestionCache[trimmedQuery]) {
        this.suggestions = this.suggestionCache[trimmedQuery];
        this.showSuggestions = this.suggestions.length > 0;
        return;
      }

      try {
        const response = await fetch(
          `http://127.0.0.1:8000/api/places?query=${encodeURIComponent(trimmedQuery)}`,
          {
            headers: {
              'Content-Type': 'application/json',
            },
          }
        );

        if (!response.ok) {
          throw new Error('Network response was not ok');
        }

        const data = await response.json();
        this.suggestions = data;
        this.suggestionCache[trimmedQuery] = data; 
        this.showSuggestions = data.length > 0;
      } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
      }
    },
    async handleSuggestionClick(suggestion) {
      this.query = suggestion.name; 
      this.showSuggestions = false;

      const latitude = suggestion.lat;
      const longitude = suggestion.lon;

      const weatherCacheKey = `${latitude},${longitude}`;
      
      if (this.weatherCache[weatherCacheKey]) {
        this.$emit('updateWeatherData', this.weatherCache[weatherCacheKey]);
        this.$emit('updateMainData', {
          mainData: this.weatherCache[weatherCacheKey].mainData,
          name: suggestion.name
        });
        return;
      }

      if (latitude && longitude) {
        try {
          const response = await fetch(
            `http://127.0.0.1:8000/api/weather?latitude=${latitude}&longitude=${longitude}`,
            {
              method: 'GET',
              headers: {
                'Content-Type': 'application/json',
              },
            }
          );

          if (!response.ok) {
            throw new Error('Network response was not ok');
          }

          const data = await response.json();
          this.weatherCache[weatherCacheKey] = data.data;  

          this.$emit('updateWeatherData', data.data);
          this.$emit('updateMainData', {
            mainData: data.mainData,
            location: suggestion.name
          });

        } catch (error) {
          console.error('There was a problem with the fetch operation:', error);
        }
      } else {
        console.error('Latitude and longitude are missing');
      }
    },
    handleClickOutside(event) {
      const searchContainer = this.$refs.searchContainer;
      if (searchContainer && !searchContainer.contains(event.target)) {
        this.showSuggestions = false;
      }
    },
  },
  watch: {
    query(newQuery) {
      if (!newQuery.trim()) {
        this.suggestions = [];
        this.showSuggestions = false;
      }
    },
  },
  mounted() {
    document.addEventListener('mousedown', this.handleClickOutside);
  },
  beforeDestroy() {
    document.removeEventListener('mousedown', this.handleClickOutside);
  },
};
</script>
