module Jekyll
  # Compiled Sass into CSS. You must specify an empty YAML front matter
  # at the beginning of the file.
  # sass|sccs -> .css
  class SassConverter < Converter
    def setup
      return if @setup
      require 'sass'
      @setup = true
    rescue LoadError
      STDERR.puts 'You are missing a library required for sass. Please run:'
      STDERR.puts '  $ [sudo] gem install haml'
      raise FatalException.new("Missing dependency: haml")
    end

    def matches(ext)
      @ext = ext
      ext =~ /sass|scss/i
    end

    def output_ext(ext)
      '.css'
    end

    def convert(content)
      setup
      syntax = (@ext =~ /sass/i) ? :sass : :scss
      begin
        Sass::Engine.new(content, :style => :compressed, :syntax => syntax).render
      rescue => e
        puts "Sass Exception (#{e.sass_line}): #{e.message}"
      end
    end
  end
end